<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Examen extends Model
{
    protected $fillable = [
        'paciente_id', 'doctor_id', 'historial_clinico_id', 'tipo', 'descripcion',
        'fecha_solicitud', 'fecha_resultado', 'resultados', 'observaciones', 'estado'
    ];

    protected $casts = [
        'fecha_solicitud' => 'date',
        'fecha_resultado' => 'date'
    ];

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function historialClinico(): BelongsTo
    {
        return $this->belongsTo(HistorialClinico::class);
    }
}
