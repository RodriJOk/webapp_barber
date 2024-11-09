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
        Schema::create('collaborators', function(Blueprint $table){
            $table->increments('id')->nullable(false);
            $table->string('name', 100)->nullable(false);
            $table->string('surname', 100)->nullable(false);
            $table->string('email', 100)->nullable(false);
            $table->string('phone', 16)->nullable(false);
            $table->dateTime('created_at');
            $table->dateTime('update_at');
            $table->integer('branch_id', 11)->nullable(false);
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
