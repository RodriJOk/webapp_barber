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
        Schema::create('professionals', function (Blueprint $table) {
            $table->increments('id'); // Clave primaria auto-incremental
            $table->string('name', 200)->nullable();
            $table->string('surname', 100)->nullable();
            $table->unsignedInteger('branch_id')->nullable(); // Usar unsignedInteger para claves foráneas
            $table->string('spacialization', 100)->nullable();
            $table->dateTime('created_at')->nullable(false);
            $table->dateTime('update_at')->nullable(false);
            $table->string('phone', 100)->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professionals');
    }
};
