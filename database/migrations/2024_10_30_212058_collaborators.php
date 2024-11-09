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
        Schema::create('collaborators', function (Blueprint $table) {
            $table->increments('id'); // Clave primaria
            $table->string('name', 100)->nullable(false);
            $table->string('surname', 100)->nullable(false);
            $table->string('email', 100)->nullable(false);
            $table->string('phone', 16)->nullable(false);
            $table->unsignedInteger('branch_id'); // Elimina la definición de clave primaria en `branch_id`
            $table->timestamps();
        
            // Define `branch_id` como clave foránea si es necesario
            $table->foreign('branch_id')->references('id')->on('branch')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaborators');
    }
};
