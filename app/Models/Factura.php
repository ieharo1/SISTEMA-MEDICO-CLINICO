<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Factura extends Model
{
    protected $fillable = [
        'paciente_id', 'cita_id', 'numero_factura', 'fecha', 'subtotal', 'iva', 'total', 'descripcion', 'estado'
    ];

    protected $casts = [
        'fecha' => 'date',
        'subtotal' => 'decimal:2',
        'iva' => 'decimal:2',
        'total' => 'decimal:2'
    ];

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }

    public function cita(): BelongsTo
    {
        return $this->belongsTo(Cita::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(FacturaItem::class);
    }
}

class FacturaItem extends Model
{
    protected $fillable = ['factura_id', 'descripcion', 'cantidad', 'precio_unitario', 'subtotal'];

    protected $casts = [
        'precio_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2'
    ];

    public function factura(): BelongsTo
    {
        return $this->belongsTo(Factura::class);
    }
}
