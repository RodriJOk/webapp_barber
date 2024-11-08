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
        Schema::create('calendar', function(Blueprint $table){
            $table->increment('id')->nullable(false);
            $table->string('hora_inicio', 100)->nullable(false);
            $table->string('hora_fin', 100)->nullable(false);
            $table->string('descripcion', 100)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendar');
    }
};
