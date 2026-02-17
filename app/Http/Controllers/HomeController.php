<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\Testimonio;
use App\Models\ValorCorporativo;
use App\Models\RedSocial;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $servicios = Servicio::activos()->get();
        $testimonios = Testimonio::activos()->get();
        $valores = ValorCorporativo::activos()->get();
        $redes = RedSocial::activas()->get();
        $posts = Post::publicados()->take(3)->get();

        return view('home', compact('servicios', 'testimonios', 'valores', 'redes', 'posts'));
    }
}
