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
        Schema::create('shift_reservation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100)->nullable(); // Asumiendo que puede ser nulo
            $table->string('apellido', 100)->nullable(); // Asumiendo que puede ser nulo
            $table->date('date'); // Sin nullable si siempre se debe especificar una fecha
            $table->time('time'); // Sin nullable si siempre se debe especificar una hora
            $table->string('observations', 100)->nullable();
            
            // Clave foránea con foreignId si está relacionada a la tabla users
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            
            $table->timestamps(); // Agrega created_at y updated_at para registro de creación/actualización
            
            // Índices
            $table->index(['date', 'time']); // Índice para optimizar consultas por fecha y hora
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift_reservation');
    }
};
