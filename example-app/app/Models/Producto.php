<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'categoria_id',
        'tamano_estandar',
        'unidad_medida',
        'precio_base',
        'stock_actual',
        'stock_maximo',
        'estado',
        'descripcion',
    ];

    protected $casts = [
        'precio_base'  => 'decimal:2',
        'stock_actual' => 'integer',
        'stock_maximo' => 'integer',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function getPorcentajeStockAttribute(): int
    {
        if ($this->stock_maximo <= 0) return 0;
        return (int) min(100, round(($this->stock_actual / $this->stock_maximo) * 100));
    }
}