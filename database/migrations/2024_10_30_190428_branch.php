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
        Schema::create('branch', function(Blueprint $table){
            $table->increments('id'); 
            $table->string('name', 100)->nullable(false);
            $table->string('address', 1000)->nullable(false);
            $table->unsignedBigInteger('id_user')->nullable(false);
            $table->string('phone')->nullable(false);
            $table->timestamp('created_at');
            $table->timestamp('updated_at'); // Cambiado a updated_at
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade'); // Asegúrate de que la clave coincida
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch');
    }
};
