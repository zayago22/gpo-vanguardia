<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\Webhook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobApplicationController extends Controller
{
    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'nombre' => 'required|string|max:120',
            'apellido' => 'required|string|max:120',
            'email' => 'required|email|max:150',
            'telefono' => 'nullable|string|max:50',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ])->validateWithBag('bolsa');

        $cvPath = $request->file('cv')->store('job_applications', 'public');

        $application = JobApplication::create([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'telefono' => $data['telefono'] ?? null,
            'cv_path' => $cvPath,
        ]);

        // Disparar webhook si está configurado
        Webhook::dispatch('bolsa', [
            'id'       => $application->id,
            'nombre'   => $application->nombre,
            'apellido' => $application->apellido,
            'email'    => $application->email,
            'telefono' => $application->telefono,
            'cv_url'   => asset('storage/' . $application->cv_path),
        ]);

        return back()->with('bolsa_success', 'Tu aplicación fue enviada. ¡Gracias por postularte!');
    }
}
