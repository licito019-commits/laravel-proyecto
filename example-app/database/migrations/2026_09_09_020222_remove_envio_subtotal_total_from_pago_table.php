<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pago', function (Blueprint $table) {
            $table->dropColumn(['metodo_envio', 'subtotal', 'total']);
        });
    }

    public function down(): void
    {
        Schema::table('pago', function (Blueprint $table) {
            $table->string('metodo_envio', 255)->nullable()->after('Metodo_pago');
            $table->decimal('subtotal', 12, 2)->nullable()->after('metodo_envio');
            $table->decimal('total', 12, 2)->nullable()->after('subtotal');
        });
    }
};