<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = [
        'titulo',
        'slug',
        'extracto',
        'contenido',
        'imagen_portada',
        'publicado',
        'fecha_publicacion',
        'user_id',
    ];

    protected $casts = [
        'publicado' => 'boolean',
        'fecha_publicacion' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublicados(Builder $query): Builder
    {
        return $query->where('publicado', true)
            ->where('fecha_publicacion', '<=', now())
            ->orderBy('fecha_publicacion', 'desc');
    }
}
