<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained()->nullOnDelete();
            $table->unsignedBigInteger('producto_id')->after('user_id');
            $table->integer('cantidad')->after('producto_id');
            $table->string('tipo_acabado')->after('cantidad');
            $table->string('color')->after('tipo_acabado');
            $table->string('fuente')->after('color');
            $table->string('metodo_envio')->after('fuente');
            $table->string('metodo_pago')->after('metodo_envio');
            $table->decimal('subtotal', 12, 2)->after('metodo_pago');
            $table->decimal('costo_envio', 12, 2)->after('subtotal');
            $table->decimal('total', 12, 2)->after('costo_envio');
            $table->string('nombre')->after('total');
            $table->string('correo')->after('nombre');
            $table->string('telefono')->after('correo');
            $table->string('direccion')->after('telefono');
            $table->string('ciudad')->after('direccion');
            $table->string('departamento')->after('ciudad');
            $table->string('estado')->default('pendiente')->after('departamento');
        });
    }

    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'user_id', 'producto_id', 'cantidad', 'tipo_acabado', 'color',
                'fuente', 'metodo_envio', 'metodo_pago', 'subtotal', 'costo_envio',
                'total', 'nombre', 'correo', 'telefono', 'direccion', 'ciudad',
                'departamento', 'estado',
            ]);
        });
    }
};