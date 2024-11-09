<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // ID del usuario autenticado
            $table->string('ip_address', 45)->nullable(); // IP del usuario
            $table->text('user_agent')->nullable(); // Información del navegador o dispositivo
            $table->text('payload'); // Datos de la sesión
            $table->integer('last_activity'); // Marca de tiempo de la última actividad para limpieza
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
