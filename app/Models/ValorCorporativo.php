<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ValorCorporativo extends Model
{
    protected $table = 'valores_corporativos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'icono',
        'activo',
        'orden',
    ];

    public function scopeActivos(Builder $query): Builder
    {
        return $query->where('activo', true)->orderBy('orden');
    }
}
