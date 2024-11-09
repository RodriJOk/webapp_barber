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
        Schema::create('suscription', function(Blueprint $table){
            $table->increments('id')->nullable(false);
            $table->string('name', 255)->nullable(false);
            $table->enum('type', ['mensual', 'anual'])->nullable(false);
            $table->timestamps('start_date');
            $table->timestamps('end_date');
            $table->enum('activo', ['si', 'no'])->nullable(false);
            $table->integer('id_pago')->nullable(false);
            $table->integer('id_cliente')->nullable(false);
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
