<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    protected $table = 'doctores';

    protected $fillable = [
        'user_id',
        'especialidad_id',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'cedula_profesional',
        'telefono',
        'correo',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function especialidad(): BelongsTo
    {
        return $this->belongsTo(Especialidad::class, 'especialidad_id');
    }

    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class, 'doctor_id');
    }

    public function getNombreCompletoAttribute(): string
    {
        return trim("Dr. {$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}");
    }
}
