<?php

namespace App\Enums;

enum RoleEnum: int
{
    case ADMIN = 1;
    case DOCTOR = 2;
    case RECEPCIONISTA = 3;

    public function label(): string
    {
        return match($this) {
            RoleEnum::ADMIN         => 'Administrador',
            RoleEnum::DOCTOR        => 'Doctor',
            RoleEnum::RECEPCIONISTA => 'Recepcionista',
        };
    }
}
