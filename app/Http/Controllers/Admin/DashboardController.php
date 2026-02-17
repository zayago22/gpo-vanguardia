<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use App\Models\Post;
use App\Models\GaleriaImagen;
use App\Models\Testimonio;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'servicios' => Servicio::count(),
            'posts' => Post::count(),
            'galeria' => GaleriaImagen::count(),
            'contactos_nuevos' => Contact::noLeidos()->count(),
        ];
        $contactos = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'contactos'));
    }
}
