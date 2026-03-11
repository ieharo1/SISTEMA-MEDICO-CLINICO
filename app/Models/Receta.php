<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Receta extends Model
{
    protected $fillable = [
        'historial_clinico_id', 'paciente_id', 'doctor_id', 'fecha',
        'medicamentos', 'dosis', 'frecuencia', 'duracion', 'instrucciones', 'observaciones'
    ];

    protected $casts = [
        'fecha' => 'date'
    ];

    public function historialClinico(): BelongsTo
    {
        return $this->belongsTo(HistorialClinico::class);
    }

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
}
