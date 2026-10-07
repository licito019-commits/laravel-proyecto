<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')->get();

        return view('producto', compact('productos'));
    }

    private function reglas(): array
    {
        return [
            'nombre'          => 'required|string|max:255',
            'categoria_id'    => 'required|exists:categorias,id',
            'tamano_estandar' => 'nullable|string|max:255',
            'unidad_medida'   => 'nullable|string|max:255',
            'precio_base'     => 'required|numeric|min:0',
            'stock_actual'    => 'required|integer|min:0',
            'stock_maximo'    => 'required|integer|min:0',
            'estado'          => 'required|in:activo,inactivo,agotado',
            'descripcion'     => 'nullable|string',
        ];
    }

    private function aPlano(Producto $producto): array
    {
        $producto->load('categoria');
        return [
            'id'     => $producto->id,
            'name'   => $producto->nombre,
            'cat'    => $producto->categoria->nombre ?? 'Otro',
            'cat_id' => $producto->categoria_id,
            'desc'   => $producto->descripcion,
            'stock'  => $producto->stock_actual,
            'max'    => $producto->stock_maximo,
            'unit'   => $producto->unidad_medida,
            'precio' => (float) $producto->precio_base,
            'tamano' => $producto->tamano_estandar,
            'estado' => $producto->estado,
        ];
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->reglas());
        $producto = Producto::create($data);

        return response()->json($this->aPlano($producto), 201);
    }

    public function update(Request $request, Producto $producto)
    {
        $data = $request->validate($this->reglas());
        $producto->update($data);

        return response()->json($this->aPlano($producto));
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return response()->json(['ok' => true]);
    }
}