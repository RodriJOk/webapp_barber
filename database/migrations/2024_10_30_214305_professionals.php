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
        Schema::create('professionals', function(Blueprint $table){
            $table->increment('id')->nullable();
            $table->string('name', 200)->nullable();
            $table->string('surname', 100)->nullable();
            $table->integer('branch_id', 11)->nullable();
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
