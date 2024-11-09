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
    Schema::create('professional_availability', function (Blueprint $table) {
        $table->increments('id'); // Sin nullable() ya que es clave primaria
        $table->unsignedInteger('professional_id');
        $table->enum('day_of_th_week', ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'])->nullable();
        $table->time('start_time')->nullable();
        $table->time('end_time')->nullable();
        $table->dateTime('created_at')->nullable(false);
        $table->dateTime('update_at')->nullable(false);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professional_availability');
    }
};
