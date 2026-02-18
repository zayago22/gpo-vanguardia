<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\RedSocial;

class BlogController extends Controller
{

    public function index()
    {
        $posts = Post::publicados()->paginate(9);
        $redes = RedSocial::activas()->get();
        $company = config('seo.company');
        return view('blog.index', compact('posts', 'redes', 'company'));
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
