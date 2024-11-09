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
            $table->increments('id')->nullable(false);
            $table->string('name', 255)->nullable(false);
            $table->string('email', 255)->nullable(false)->unique();
            $table->timestamps('email_verified_at');
            $table->string('password', 255)->nullable(false);
            $table->string('remember_toker', 100);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
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
