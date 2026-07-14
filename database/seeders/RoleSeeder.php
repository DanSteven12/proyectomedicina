<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insertOrIgnore([
            [
                'id'          => RoleEnum::ADMIN->value,
                'nombre'      => 'Administrador',
                'descripcion' => 'Acceso completo al sistema.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id'          => RoleEnum::DOCTOR->value,
                'nombre'      => 'Doctor',
                'descripcion' => 'Gestión de citas y consultas propias.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id'          => RoleEnum::RECEPCIONISTA->value,
                'nombre'      => 'Recepcionista',
                'descripcion' => 'Registro de pacientes y agenda de citas.',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
