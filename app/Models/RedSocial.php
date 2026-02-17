<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class RedSocial extends Model
{
    protected $table = 'redes_sociales';

    protected $fillable = [
        'nombre',
        'icono',
        'url',
        'activo',
        'orden',
    ];

    public function scopeActivas(Builder $query): Builder
    {
        return $query->where('activo', true)->orderBy('orden');
    }
}
