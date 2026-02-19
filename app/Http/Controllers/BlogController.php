<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\RedSocial;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index(Request $request)
    {
        $query = Post::publicados();

        if ($request->filled('categoria')) {
            $categoria = $request->input('categoria');
            $query->where('categoria', $categoria);
        }

        if ($request->filled('q')) {
            $search = trim($request->input('q'));
            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'like', "%{$search}%")
                  ->orWhere('extracto', 'like', "%{$search}%")
                  ->orWhere('contenido', 'like', "%{$search}%");
            });
        }

        if ($request->filled('desde')) {
            $query->whereDate('fecha_publicacion', '>=', $request->date('desde'));
        }

        if ($request->filled('hasta')) {
            $query->whereDate('fecha_publicacion', '<=', $request->date('hasta'));
        }

        $posts = $query->paginate(9)->appends($request->query());
        $categorias = Post::whereNotNull('categoria')
            ->where('categoria', '!=', '')
            ->distinct()
            ->orderBy('categoria')
            ->pluck('categoria');
        $redes = RedSocial::activas()->get();
        $company = config('seo.company');

        return view('blog.index', compact('posts', 'redes', 'company', 'categorias'));
    }

    public function show(Post $post)
    {
        if (!$post->publicado) {
            abort(404);
        }
        $redes = RedSocial::activas()->get();
        $related = Post::publicados()->where('id', '!=', $post->id)->take(3)->get();
        $company = config('seo.company');
        return view('blog.show', compact('post', 'redes', 'related', 'company'));
    }
}
