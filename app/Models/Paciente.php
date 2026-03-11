<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paciente extends Model
{
    protected $fillable = [
        'nombre', 'apellido', 'cedula', 'fecha_nacimiento', 'sexo',
        'telefono', 'email', 'direccion', 'tipo_sangre', 'alergias',
        'enfermedades_cronicas', 'contacto_emergencia', 'telefono_emergencia', 'activo'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'activo' => 'boolean'
    ];

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

    public function facturas(): HasMany
    {
        return $this->hasMany(Factura::class);
    }

    public function getNombreCompletoAttribute(): string
    {
        return $this->nombre . ' ' . $this->apellido;
    }
}
