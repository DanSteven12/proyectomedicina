<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('doctor_id');
            $table->date('fecha');
            $table->time('hora');
            $table->text('motivo');
            $table->enum('estado', ['Pendiente', 'Confirmada', 'Cancelada', 'Finalizada'])
                  ->default('Pendiente');
            $table->text('observaciones')->nullable();
            $table->timestamps();

            $table->foreign('paciente_id')
                  ->references('id')
                  ->on('pacientes')
                  ->constraintName('fk_cita_paciente');

            $table->foreign('doctor_id')
                  ->references('id')
                  ->on('doctores')
                  ->constraintName('fk_cita_doctor');

            $table->unique(['doctor_id', 'fecha', 'hora'], 'uq_doctor_fecha_hora');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
