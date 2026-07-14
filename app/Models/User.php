<?php

namespace App\Models;

use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'role_id'           => 'integer',
    ];

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'role_id');
    }

    public function doctor(): HasOne
    {
        return $this->hasOne(Doctor::class, 'user_id');
    }

    public function esAdmin(): bool
    {
        return $this->role_id === RoleEnum::ADMIN->value;
    }

    public function esDoctor(): bool
    {
        return $this->role_id === RoleEnum::DOCTOR->value;
    }

    public function esRecepcionista(): bool
    {
        return $this->role_id === RoleEnum::RECEPCIONISTA->value;
    }
}
