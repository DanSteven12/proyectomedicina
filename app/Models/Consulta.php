<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consulta extends Model
{
    protected $table = 'consultas';

    protected $fillable = [
        'cita_id',
        'diagnostico',
        'tratamiento',
        'receta',
        'peso',
        'talla',
        'temperatura',
        'presion_arterial',
    ];

    protected $casts = [
        'peso'        => 'decimal:2',
        'talla'       => 'decimal:2',
        'temperatura' => 'decimal:2',
    ];

    public function cita(): BelongsTo
    {
        return $this->belongsTo(Cita::class, 'cita_id');
    }
}
