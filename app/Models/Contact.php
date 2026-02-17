<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Contact extends Model
{
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'empresa',
        'mensaje',
        'leido',
    ];

    public function scopeNoLeidos(Builder $query): Builder
    {
        return $query->where('leido', false);
    }
}
