<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Webhook;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function index()
    {
        $webhooks = Webhook::orderBy('evento')->get();

        // Asegurar que existan registros para todos los eventos
        foreach (Webhook::EVENTOS as $evento => $nombre) {
            if (!$webhooks->where('evento', $evento)->count()) {
                $webhook = Webhook::create([
                    'nombre' => $nombre,
                    'evento' => $evento,
                    'url'    => '',
                    'activo' => false,
                ]);
                $webhooks->push($webhook);
            }
        }

        $webhooks = $webhooks->sortBy('evento')->values();

        return view('admin.webhooks.index', compact('webhooks'));
    }

    public function update(Request $request, Webhook $webhook)
    {
        $data = $request->validate([
            'url'    => 'nullable|url|max:500',
            'activo' => 'boolean',
            'secret' => 'nullable|string|max:100',
        ]);

        $data['activo'] = $request->has('activo') && !empty($data['url']);

        $webhook->update($data);

        return redirect()->route('admin.webhooks.index')
            ->with('success', "Webhook «{$webhook->nombre}» actualizado.");
    }

    /**
     * Enviar un test al webhook configurado.
     */
    public function test(Webhook $webhook)
    {
        if (empty($webhook->url)) {
            return redirect()->route('admin.webhooks.index')
                ->with('error', 'Configura una URL antes de hacer un test.');
        }

        Webhook::dispatch($webhook->evento, [
            'test'    => true,
            'mensaje' => 'Este es un envío de prueba desde GPO Vanguardia.',
        ]);

        return redirect()->route('admin.webhooks.index')
            ->with('success', "Test enviado a «{$webhook->nombre}». Revisa el estado en unos segundos.");
    }
}
