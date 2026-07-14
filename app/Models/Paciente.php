<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paciente extends Model
{
    use SoftDeletes;

    protected $table = 'pacientes';

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'sexo',
        'fecha_nacimiento',
        'curp',
        'telefono',
        'correo',
        'direccion',
        'codigo_postal',
        'estado',
        'municipio',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class, 'paciente_id');
    }

    public function getNombreCompletoAttribute(): string
    {
        return trim("{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}");
    }
}
