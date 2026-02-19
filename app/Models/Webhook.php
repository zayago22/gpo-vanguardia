<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Webhook extends Model
{
    protected $fillable = [
        'nombre',
        'evento',
        'url',
        'activo',
        'secret',
        'ultimo_envio',
        'ultimo_estado',
        'ultimo_error',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'ultimo_envio' => 'datetime',
    ];

    /**
     * Eventos disponibles para webhooks.
     */
    public const EVENTOS = [
        'contacto'     => 'Nuevo mensaje de contacto',
        'bolsa'        => 'Nueva aplicación de empleo',
        'post_creado'  => 'Nuevo post publicado',
    ];

    /**
     * Dispara el webhook para un evento dado.
     * Envía los datos como JSON POST al URL configurado.
     */
    public static function dispatch(string $evento, array $data): void
    {
        $webhook = static::where('evento', $evento)
            ->where('activo', true)
            ->first();

        if (!$webhook || empty($webhook->url)) {
            return;
        }

        // Ejecutar en segundo plano para no bloquear la respuesta al usuario
        dispatch(function () use ($webhook, $evento, $data) {
            try {
                $payload = [
                    'evento'    => $evento,
                    'timestamp' => now()->toIso8601String(),
                    'data'      => $data,
                ];

                $request = Http::timeout(10)
                    ->withHeaders([
                        'Content-Type'     => 'application/json',
                        'X-Webhook-Event'  => $evento,
                        'User-Agent'       => 'GPOVanguardia-Webhook/1.0',
                    ]);

                // Si hay un secret, agregar firma HMAC
                if ($webhook->secret) {
                    $signature = hash_hmac('sha256', json_encode($payload), $webhook->secret);
                    $request = $request->withHeaders([
                        'X-Webhook-Signature' => $signature,
                    ]);
                }

                $response = $request->post($webhook->url, $payload);

                $webhook->update([
                    'ultimo_envio'  => now(),
                    'ultimo_estado' => $response->successful() ? 'ok' : 'error',
                    'ultimo_error'  => $response->successful() ? null : "HTTP {$response->status()}",
                ]);
            } catch (\Throwable $e) {
                Log::warning("Webhook [{$evento}] falló: {$e->getMessage()}");

                $webhook->update([
                    'ultimo_envio'  => now(),
                    'ultimo_estado' => 'error',
                    'ultimo_error'  => substr($e->getMessage(), 0, 500),
                ]);
            }
        })->afterResponse();
    }
}
