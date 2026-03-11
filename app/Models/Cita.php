<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cita extends Model
{
    protected $fillable = ['paciente_id', 'doctor_id', 'fecha', 'hora', 'estado', 'motivo', 'observaciones'];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'datetime:H:i'
    ];

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function facturas(): HasMany
    {
        return $this->hasMany(Factura::class);
    }
}
