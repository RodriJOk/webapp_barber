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
        Schema::create('clients', function(Blueprint $table){
            $table->increments('id')->nullable(false);
            $table->string('name', 300)->nullable(false);
            $table->string('surname', 100)->nullable(false);
            $table->dateTime('created_at');
            $table->dateTime('update_at');
            $table->integer('id_branch')->nullable(false);
            $table->string('phone', 100)->nullable(false);
            $table->string('email', 100)->nullable(false);
            $table->foreign('id_branch')->references('id')->on('branch')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
