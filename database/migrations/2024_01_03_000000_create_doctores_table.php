<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('especialidad_id');
            $table->string('nombre', 100);
            $table->string('apellido_paterno', 100);
            $table->string('apellido_materno', 100)->nullable();
            $table->string('cedula_profesional', 30)->unique();
            $table->string('telefono', 15)->nullable();
            $table->string('correo', 150)->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->constraintName('fk_doctor_user');

            $table->foreign('especialidad_id')
                  ->references('id')
                  ->on('especialidades')
                  ->constraintName('fk_doctor_especialidad');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctores');
    }
};
