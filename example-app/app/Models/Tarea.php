<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria', 'titulo', 'cliente_id', 'tamano', 'cantidad',
        'fecha_limite', 'progreso', 'prioridad', 'estado', 'comentario', 'leida',
    ];

    protected $casts = [
        'fecha_limite' => 'date',
        'leida' => 'boolean',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function usuarios(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'asignaciones');
    }
}