<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Testimonio extends Model
{
    protected $fillable = [
        'nombre',
        'cargo',
        'empresa',
        'texto',
        'estrellas',
        'activo',
        'orden',
    ];

    public function scopeActivos(Builder $query): Builder
    {
        return $query->where('activo', true)->orderBy('orden');
    }
}
