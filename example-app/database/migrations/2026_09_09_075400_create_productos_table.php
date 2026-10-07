<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('categoria_id')->constrained('categorias')->cascadeOnDelete();
            $table->string('tamano_estandar')->nullable();
            $table->string('unidad_medida')->nullable();
            $table->decimal('precio_base', 12, 2);
            $table->unsignedInteger('stock_actual')->default(0);
            $table->unsignedInteger('stock_maximo')->default(0);
            $table->enum('estado', ['activo', 'inactivo', 'agotado'])->default('activo');
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};