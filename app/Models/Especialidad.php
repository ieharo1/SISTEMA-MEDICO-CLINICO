<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Especialidad extends Model
{
    protected $fillable = ['nombre', 'descripcion'];

    public function doctores(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }
}
