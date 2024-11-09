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
            $table->string('nombre', 100)->nullable();
            $table->string('apellido', 100)->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('observations', 100)->nullable();
            $table->bigInteger('id_user'); // Sin el segundo parámetro `20`
            
            $table->timestamps(); // Agrega `created_at` y `updated_at`
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
