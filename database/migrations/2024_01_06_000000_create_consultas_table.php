<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cita_id')->unique();
            $table->text('diagnostico')->nullable();
            $table->text('tratamiento')->nullable();
            $table->text('receta')->nullable();
            $table->decimal('peso', 5, 2)->nullable();
            $table->decimal('talla', 5, 2)->nullable();
            $table->decimal('temperatura', 4, 2)->nullable();
            $table->string('presion_arterial', 20)->nullable();
            $table->timestamps();

            $table->foreign('cita_id')
                  ->references('id')
                  ->on('citas')
                  ->constraintName('fk_consulta_cita');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
