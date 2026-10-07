<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('categoria');           // ej: "Valla publicitaria"
            $table->string('titulo');
            $table->foreignId('cliente_id')->constrained('users')->cascadeOnDelete();
            $table->string('tamaño')->nullable();   // ej: "8m x 3m"
            $table->integer('cantidad')->nullable();
            $table->date('fecha_limite');
            $table->unsignedTinyInteger('progreso')->default(0); // 0-100
            $table->enum('prioridad', ['alta', 'media', 'baja'])->default('media');
            $table->enum('estado', ['pendiente', 'en_progreso', 'revision', 'completada'])->default('pendiente');
            $table->text('comentario')->nullable();
            $table->boolean('leida')->default(false); // para el badge de mensajes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};