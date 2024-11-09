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
        Schema::create('suscription', function (Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->string('name', 255)->nullable(false);
            $table->string('type', 10)->nullable(false);
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();
            $table->string('activo', 2)->nullable(false);
            $table->integer('id_pago')->nullable(false);
            $table->integer('id_cliente')->nullable(false);
        });

        // Agrega las restricciones de `CHECK` después de crear la tabla
        DB::statement("ALTER TABLE suscription ADD CONSTRAINT check_type CHECK (type IN ('mensual', 'anual'))");
        DB::statement("ALTER TABLE suscription ADD CONSTRAINT check_activo CHECK (activo IN ('si', 'no'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suscription');
    }
};
