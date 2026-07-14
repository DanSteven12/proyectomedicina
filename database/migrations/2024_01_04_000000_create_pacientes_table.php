<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 100);
            $table->string('apellido_paterno', 100);
            $table->string('apellido_materno', 100)->nullable();
            $table->enum('sexo', ['Masculino', 'Femenino']);
            $table->date('fecha_nacimiento')->nullable();
            $table->string('curp', 18)->unique()->nullable();
            $table->string('telefono', 15)->nullable();
            $table->string('correo', 150)->nullable();
            $table->text('direccion')->nullable();
            $table->string('codigo_postal', 5)->nullable();
            $table->string('estado', 80)->nullable();
            $table->string('municipio', 80)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
