<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    protected $fillable = ['user_id', 'especialidad_id', 'cedula', 'telefono', 'direccion', 'hora_inicio', 'hora_fin', 'activo'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function especialidad(): BelongsTo
    {
        return $this->belongsTo(Especialidad::class);
    }

    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }

    public function historiales(): HasMany
    {
        return $this->hasMany(HistorialClinico::class);
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
