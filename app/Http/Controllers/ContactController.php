<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Webhook;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'telefono' => 'nullable|string|max:50',
            'empresa'  => 'nullable|string|max:255',
            'mensaje'  => 'required|string|max:5000',
        ]);

        $contact = Contact::create($validated);

        // Disparar webhook si está configurado
        Webhook::dispatch('contacto', [
            'id'       => $contact->id,
            'nombre'   => $contact->nombre,
            'email'    => $contact->email,
            'telefono' => $contact->telefono,
            'empresa'  => $contact->empresa,
            'mensaje'  => $contact->mensaje,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mensaje enviado correctamente. Nos pondremos en contacto pronto.'
        ]);
    }
}
