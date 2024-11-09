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
        Schema::create('users', function(Blueprint $table){
            $table->bigIncrements('id'); // O puedes usar increments si prefieres enteros más pequeños
            $table->string('name', 255)->nullable(false);
            $table->string('email', 255)->unique()->nullable(false);
            $table->timestamp('email_verified_at')->nullable(); // Asegúrate de no especificar nada dentro del paréntesis
            $table->string('password', 255)->nullable(false);
            $table->rememberToken();
            $table->timestamps(); // Este método agrega `created_at` y `updated_at`
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
