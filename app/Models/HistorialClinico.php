<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HistorialClinico extends Model
{
    protected $fillable = [
        'paciente_id', 'doctor_id', 'cita_id', 'fecha', 'peso', 'altura',
        'presion_sistolica', 'presion_diastolica', 'temperatura',
        'sintomas', 'diagnostico', 'tratamiento', 'observaciones'
    ];

    protected $casts = [
        'fecha' => 'date',
        'peso' => 'decimal:2',
        'altura' => 'decimal:2'
    ];

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function cita(): BelongsTo
    {
        return $this->belongsTo(Cita::class);
    }

    public function recetas(): HasMany
    {
        return $this->hasMany(Receta::class);
    }

    public function examenes(): HasMany
    {
        return $this->hasMany(Examen::class);
    }
}
