<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PedidoController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'producto_id'   => 'required|integer|exists:productos,id',
            'cantidad'      => 'required|integer|min:10',
            'tipo_acabado'  => 'required|string',
            'color'         => 'required|string',
            'fuente'        => 'required|string',
            'metodo_envio'  => 'required|string',
            'metodo_pago'   => 'required|string',
            'subtotal'      => 'required|numeric',
            'costo_envio'   => 'required|numeric',
            'total'         => 'required|numeric',
            'nombre'        => 'required|string|max:255',
            'correo'        => 'required|email|max:255',
            'telefono'      => 'required|string|max:30',
            'direccion'     => 'required|string|max:255',
            'descripcion'   => 'required|string|max:1000',  
            'ciudad'        => 'required|string|max:100',
            'departamento'  => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Datos inválidos, revisa el formulario.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $pedido = Pedido::create($validator->validated() + [
            'user_id' => auth()->check() ? auth()->id() : null,
            'estado'  => 'pendiente',
        ]);

        return response()->json([
            'message' => 'Pedido guardado correctamente.',
            'pedido'  => $pedido,
        ], 201);
    }
}