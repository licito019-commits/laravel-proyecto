<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pago';
    protected $primaryKey = 'COG_Pago';

    protected $fillable = [
        'Metodo_pago',
        'Estado',
        'comprobante',
        'pedido_id',
    ];

    public $timestamps = false; // tu tabla pago no tiene created_at/updated_at

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }
}