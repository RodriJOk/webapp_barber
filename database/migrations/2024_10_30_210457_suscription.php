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
        Schema::create('suscription', function (Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->string('name', 255)->nullable(false);
            $table->string('type', 10)->nullable(false); // Cambia enum a string con longitud adecuada
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();
            $table->string('activo', 2)->nullable(false); // Cambia enum a string con longitud adecuada
            $table->integer('id_pago')->nullable(false);
            $table->integer('id_cliente')->nullable(false);

            // Restricciones de check para simular el enum
            $table->check("type in ('mensual', 'anual')");
            $table->check("activo in ('si', 'no')");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suscription');
    }
};
