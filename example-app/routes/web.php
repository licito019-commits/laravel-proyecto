<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PanelDisenadorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return match (auth()->user()->role) {
        'administrador' => redirect()->route('dashboard.administrador'),
        'empleado' => redirect()->route('dashboard.empleado'),
        default => redirect()->route('dashboard.cliente'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/cuenta-desactivada', function () {
    return view('cuenta-desactivada');
})->name('cuenta.desactivada');

Route::get('/dashboard/cliente', function () {
    return view('dashboard-cliente');
})->middleware(['auth', 'role:cliente'])->name('dashboard.cliente');

Route::get('/dashboard/empleado', [PanelDisenadorController::class, 'index'])->middleware(['auth', 'role:empleado'])->name('dashboard.empleado');

Route::post('/dashboard/empleado/{id}/leida', [PanelDisenadorController::class, 'marcarLeida'])->middleware(['auth', 'role:empleado'])->name('panel.disenador.leida');

Route::get('/dashboard/administrador', function () {

    $pedidos = \App\Models\Pedido::with(['cliente', 'producto', 'disenador'])->get()->map(function ($p) {
        return [
            'id'        => 'PED-' . str_pad($p->id, 3, '0', STR_PAD_LEFT),
            'real_id'   => $p->id,
            'client'    => $p->cliente->name ?? $p->nombre ?? '—',
            'contact'   => $p->correo ?? $p->cliente->email ?? '—',
            'product'   => $p->producto->nombre ?? '—',
            'title'     => $p->descripcion ?: ($p->producto->nombre ?? 'Pedido sin título'),
            'size'      => $p->tipo_acabado . ' · ' . $p->color,
            'qty'       => $p->cantidad,
            'location'  => trim(($p->direccion ?? '') . ', ' . ($p->ciudad ?? '')),
            'budget'    => (float) $p->total,
            'deadline'  => '—',
            'status'    => $p->estado,
            'priority'  => 'media',
            'designer'  => $p->disenador->name ?? 'Sin asignar',
            'brief'     => $p->descripcion ?? 'Sin descripción.',
            'submitted' => $p->created_at->format('Y-m-d'),
            'files'     => [],
            'comments'  => [],
        ];
    });

    $clientes = \App\Models\User::where('role', 'cliente')->get()->map(function ($u) {
        $pedido = \App\Models\Pedido::with('producto')->where('user_id', $u->id)->latest()->first();

        return [
            'id'       => $u->id,
            'name'     => $u->name,
            'contact'  => $u->name,
            'phone'    => $pedido->telefono ?? '—',
            'email'    => $u->email,
            'product'  => $pedido->producto->nombre ?? '—',
            'campaign' => $pedido?->descripcion ?: ($pedido?->producto->nombre ?? 'Sin pedidos aún'),
            'activo'   => (bool) $u->activo,
        ];
    });

    $categorias = \App\Models\Categoria::orderBy('nombre')->get();

    $productos = \App\Models\Producto::with('categoria')->get()->map(function ($pr) {
        return [
            'id'     => $pr->id,
            'name'   => $pr->nombre,
            'cat'    => $pr->categoria->nombre ?? 'Otro',
            'cat_id' => $pr->categoria_id,
            'desc'   => $pr->descripcion,
            'stock'  => $pr->stock_actual,
            'max'    => $pr->stock_maximo,
            'unit'   => $pr->unidad_medida,
            'precio' => (float) $pr->precio_base,
            'tamano' => $pr->tamano_estandar,
            'estado' => $pr->estado,
        ];
    });

    $disenadores = \App\Models\User::where('role', 'empleado')->get()->map(function ($u) {
        return [
            'id'      => $u->id,
            'name'    => $u->name,
            'email'   => $u->email,
            'phone'   => $u->telefono ?? '—',
            'activo'  => (bool) $u->activo,
        ];
    });

    return view('dashboard-administrador', compact('pedidos', 'clientes', 'productos', 'disenadores', 'categorias'));

})->middleware(['auth', 'role:administrador'])->name('dashboard.administrador');

// ---- RUTAS DEL CATÁLOGO Y PEDIDOS ----
Route::middleware('auth')->group(function () {
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
});
Route::post('/pedido', [PedidoController::class, 'store'])->name('pedido.store');

Route::post('/productos', [ProductoController::class, 'store']);
Route::put('/productos/{producto}', [ProductoController::class, 'update']);
Route::delete('/productos/{producto}', [ProductoController::class, 'destroy']);

// ---- ACTUALIZAR ESTADO DE UN PEDIDO (aprobar/rechazar/revisión) ----
// NUEVO: al pasar a "aprobada" se descuenta stock_actual del producto por la
// cantidad del pedido. Si un pedido ya aprobado pasa a otro estado
// (rechazada, revision, pendiente) el stock se devuelve. Todo va dentro de una
// transacción con bloqueo de filas para evitar stock negativo o descuentos dobles.
Route::patch('/pedidos/{id}/estado', function (\Illuminate\Http\Request $request, $id) {
    $request->validate([
        'estado' => 'required|string|in:pendiente,revision,aprobada,rechazada',
    ]);

    $resultado = \Illuminate\Support\Facades\DB::transaction(function () use ($request, $id) {
        $pedido = \App\Models\Pedido::lockForUpdate()->findOrFail($id);

        $estadoAnterior = $pedido->estado;
        $estadoNuevo    = $request->estado;

        $producto = $pedido->producto_id
            ? \App\Models\Producto::lockForUpdate()->find($pedido->producto_id)
            : null;

        // Pasa a aprobada desde cualquier otro estado -> descontar
        if ($producto && $estadoAnterior !== 'aprobada' && $estadoNuevo === 'aprobada') {
            if ($producto->stock_actual < $pedido->cantidad) {
                abort(422, 'Stock insuficiente para aprobar este pedido. Disponible: '
                    . $producto->stock_actual . ', solicitado: ' . $pedido->cantidad);
            }
            $producto->decrement('stock_actual', $pedido->cantidad);
        }

        // Estaba aprobada y cambia a otro estado -> devolver
        if ($producto && $estadoAnterior === 'aprobada' && $estadoNuevo !== 'aprobada') {
            $producto->increment('stock_actual', $pedido->cantidad);
        }

        $pedido->estado = $estadoNuevo;
        $pedido->save();

        if ($estadoNuevo === 'aprobada' && !\App\Models\Pago::where('pedido_id', $pedido->id)->exists()) {
            \App\Models\Pago::create([
                'Metodo_pago' => $pedido->metodo_pago,
                'Estado'      => 'aprobada',
                'comprobante' => null,
                'pedido_id'   => $pedido->id,
            ]);
        }

        return [
            'estado'      => $pedido->estado,
            'producto_id' => $producto?->id,
            'stock'       => $producto ? $producto->fresh()->stock_actual : null,
        ];
    });

    return response()->json([
        'ok'          => true,
        'estado'      => $resultado['estado'],
        'producto_id' => $resultado['producto_id'],
        'stock'       => $resultado['stock'],
    ]);
})->middleware(['auth', 'role:administrador'])->name('pedidos.estado');

// ---- ASIGNAR DISEÑADOR A UN PEDIDO ----
Route::patch('/pedidos/{id}/asignar-disenador', function (\Illuminate\Http\Request $request, $id) {
    $request->validate([
        'disenador_id' => 'required|integer|exists:users,id',
    ]);

    $pedido = \App\Models\Pedido::findOrFail($id);
    $pedido->disenador_id = $request->disenador_id;
    $pedido->save();

    return response()->json(['ok' => true, 'disenador_id' => $pedido->disenador_id]);
})->middleware(['auth', 'role:administrador'])->name('pedidos.asignar-disenador');

// ---- ACTIVAR / DESACTIVAR UN USUARIO (cliente o diseñador) ----
Route::patch('/usuarios/{id}/activo', function (\Illuminate\Http\Request $request, $id) {
    $request->validate([
        'activo' => 'required|boolean',
    ]);

    $usuario = \App\Models\User::findOrFail($id);
    $usuario->activo = $request->activo;
    $usuario->save();

    return response()->json(['ok' => true, 'activo' => $usuario->activo]);
})->middleware(['auth', 'role:administrador'])->name('usuarios.activo');