<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|max:255',
            'extracto' => 'nullable|max:500',
            'contenido' => 'required|max:50000',
            'imagen_portada' => 'nullable|image|max:2048',
            'publicado' => 'boolean',
            'fecha_publicacion' => 'nullable|date',
        ]);

        $data['slug'] = Str::slug($data['titulo']);
        $data['publicado'] = $request->has('publicado');
        $data['user_id'] = auth()->id();
        $data['fecha_publicacion'] = $data['fecha_publicacion'] ?? now();

        if ($request->hasFile('imagen_portada')) {
            $data['imagen_portada'] = $request->file('imagen_portada')->store('posts', 'public');
        }

        Post::create($data);
        return redirect()->route('admin.posts.index')->with('success', 'Post creado correctamente.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.form', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'titulo' => 'required|max:255',
            'extracto' => 'nullable|max:500',
            'contenido' => 'required|max:50000',
            'imagen_portada' => 'nullable|image|max:2048',
            'publicado' => 'boolean',
            'fecha_publicacion' => 'nullable|date',
        ]);

        $data['slug'] = Str::slug($data['titulo']);
        $data['publicado'] = $request->has('publicado');

        if ($request->hasFile('imagen_portada')) {
            $data['imagen_portada'] = $request->file('imagen_portada')->store('posts', 'public');
        }

        $post->update($data);
        return redirect()->route('admin.posts.index')->with('success', 'Post actualizado correctamente.');
    }

    public function show(Post $post)
    {
        return redirect()->route('admin.posts.edit', $post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post eliminado.');
    }
}
