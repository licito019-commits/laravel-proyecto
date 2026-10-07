<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'user_id',
        'disenador_id',
        'producto_id',
        'cantidad',
        'tipo_acabado',
        'color',
        'fuente',
        'metodo_envio',
        'metodo_pago',
        'subtotal',
        'costo_envio',
        'total',
        'nombre',
        'correo',
        'telefono',
        'direccion',
        'ciudad',
        'departamento',
        'estado',
        'descripcion',
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function disenador()
    {
        return $this->belongsTo(User::class, 'disenador_id');
    }

    public function producto()
{
    return $this->belongsTo(Producto::class, 'producto_id');
}
    public function pago()
{
    return $this->hasOne(Pago::class, 'pedido_id');
}
}