<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PanelDisenadorController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();

        $pedidos = $usuario->pedidosAsignados()->with(['cliente', 'producto'])->latest()->get();

        $stats = [
            'activas'     => $pedidos->whereIn('estado', ['pendiente', 'revision'])->count(),
            'revision'    => $pedidos->where('estado', 'revision')->count(),
            'completadas' => $pedidos->where('estado', 'aprobada')
                                ->where('updated_at', '>=', now()->startOfMonth())
                                ->count(),
            'entregas_semana' => $pedidos->filter(function ($p) {
                                $fecha = $p->producto->Fecha_entrega ?? null;
                                return $fecha && \Carbon\Carbon::parse($fecha)->between(now()->startOfWeek(), now()->endOfWeek());
                            })->count(),
            'urgentes' => $pedidos->filter(function ($p) {
                                $fecha = $p->producto->Fecha_entrega ?? null;
                                return $fecha && \Carbon\Carbon::parse($fecha)->between(now(), now()->addDays(7));
                            })->count(),
        ];

        $mapaProgreso = ['pendiente' => 0, 'revision' => 50, 'aprobada' => 100, 'rechazada' => 0];

        $tareas = $pedidos->map(function ($p) use ($mapaProgreso) {

            $p->categoria_display    = $p->producto->Nom_Producto ?? 'Pedido';
            $p->titulo_display       = $p->descripcion ?: ($p->producto->Nom_Producto ?? 'Pedido sin título');
            $p->tamano_display       = trim(($p->tipo_acabado ?? '') . ' - ' . ($p->color ?? ''), ' - ');
            $p->fecha_limite_display = $p->producto->Fecha_entrega ?? null;
            $p->progreso_display     = $mapaProgreso[$p->estado] ?? 0;
            $p->prioridad_display    = 'media';

            // ---- Nuevos accessors que faltaban, tomados directo de la tabla "pedidos" ----

            // Presupuesto: columna "total"
            $p->presupuesto_display = $p->total
                ? '$ ' . number_format((float) $p->total, 0, ',', '.')
                : '—';

            // Ubicación / destino: direccion + ciudad + departamento
            $p->ubicacion_display = collect([$p->direccion, $p->ciudad, $p->departamento])
                ->filter()
                ->implode(', ');

            // Contacto: correo + telefono guardados en el propio pedido (no en el usuario)
            $p->contacto_display = collect([$p->correo, $p->telefono])
                ->filter()
                ->implode(' · ');

            // Nombre y correo "reales" del pedido (lo que el cliente puso al ordenar,
            // no necesariamente el correo de su cuenta)
            $p->nombre_cliente_display = $p->nombre ?: ($p->cliente->name ?? 'Cliente');
            $p->correo_cliente_display = $p->correo ?: ($p->cliente->email ?? '');

            return $p;
        });

        $notificaciones = $tareas->map(function ($p) {
            return [
                'id'        => $p->id,
                'remitente' => $p->nombre_cliente_display,
                'resumen'   => $p->descripcion ? 'Nueva instrucción: ' . $p->descripcion : 'Actualización de pedido',
                'hora'      => $p->updated_at->diffForHumans(),
                'leida'     => $p->leida,
                'categoria' => $p->categoria_display,
                'titulo'    => $p->titulo_display,
                'cliente'   => $p->nombre_cliente_display,
                'detalles'  => [
                    'Tamaño'       => $p->tamano_display ?: '—',
                    'Cantidad'     => $p->cantidad,
                    'Presupuesto'  => $p->presupuesto_display,
                    'Ubicación'    => $p->ubicacion_display ?: '—',
                    'Límite'       => $p->fecha_limite_display ?? '—',
                    'Estado'       => ucfirst($p->estado),
                ],
                'comentario' => $p->descripcion,
            ];
        })->values();

        return view('dashboard-empleado', compact('usuario', 'tareas', 'stats', 'notificaciones'));
    }

    public function marcarLeida($id)
    {
        $pedido = Auth::user()->pedidosAsignados()->findOrFail($id);
        $pedido->update(['leida' => true]);

        return response()->json(['ok' => true]);
    }
}