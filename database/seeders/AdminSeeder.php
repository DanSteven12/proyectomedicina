<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@centrosalud.mx'],
            [
                'role_id'  => RoleEnum::ADMIN->value,
                'name'     => 'Administrador Sistema',
                'password' => Hash::make('Admin1234!'),
            ]
        );
    }
}
