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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->string('name', 255)->nullable(false);
            $table->string('email', 255)->nullable(false)->unique();
            $table->timestamp('email_verified_at')->nullable(); // Campo separado, sin el uso de timestamps
            $table->string('password', 255)->nullable(false);
            $table->string('remember_token', 100)->nullable(false);
            $table->timestamps(); // Agrega created_at y updated_at automáticamente
            $table->unsignedInteger('rol_id')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
