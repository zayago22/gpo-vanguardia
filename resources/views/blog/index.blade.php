@extends('layouts.public')

@section('title', 'Blog — GPO Vanguardia')

@section('styles')
    <style>
        :root {
            --primary: #4338CA;
            --primary-light: #6366F1;
            --primary-dark: #3730A3;
            --secondary: #818CF8;
            --accent: #A78BFA;
            --dark: #1E1B4B;
            --gray-50: #F8FAFC;
            --gray-100: #F1F5F9;
            --gray-200: #E2E8F0;
            --gray-400: #94A3B8;
            --gray-500: #64748B;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1E293B;
            --white: #FFFFFF;
            --gradient: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 50%, var(--secondary) 100%);
        }
        body { font-family: 'Montserrat', sans-serif; color: var(--gray-700); background: var(--gray-50); }
        .blog-hero { background: var(--gradient); padding: 80px 0 50px; text-align: center; margin-top: 70px; }
        .blog-hero h1 { color: #fff; font-size: 36px; font-weight: 800; }
        .blog-hero p { color: rgba(255,255,255,0.8); font-size: 16px; }
        .post-card { background: var(--white); border-radius: 14px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border: 1px solid var(--gray-200); transition: all 0.3s; }
        .post-card:hover { transform: translateY(-4px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
        .post-card img { width: 100%; height: 200px; object-fit: cover; }
        .post-card-body { padding: 20px; }
        .post-card-body h3 { font-size: 18px; font-weight: 700; color: var(--dark); margin-bottom: 8px; }
        .post-card-body h3 a { color: inherit; text-decoration: none; }
        .post-card-body h3 a:hover { color: var(--primary); }
        .post-card-body p { font-size: 14px; color: var(--gray-500); line-height: 1.6; }
        .post-card-meta { font-size: 12px; color: var(--gray-400); }
    </style>
@endsection

@section('content')
    <section class="blog-hero">
        <div class="container">
            <h1>Blog</h1>
            <p>Noticias, artículos y actualizaciones de Grupo Vanguardia</p>
        </div>
    </section>

    <section style="padding: 60px 0; background: #F8FAFC; min-height: 50vh;">
        <div class="container">
            @if($posts->count() > 0)
            <div class="row g-4">
                @foreach($posts as $post)
                <div class="col-lg-4 col-md-6">
                    <div class="post-card">
                        @if($post->imagen_portada)
                            <img src="{{ asset('storage/' . $post->imagen_portada) }}" alt="{{ $post->titulo }}">
                        @else
                            <div style="width: 100%; height: 200px; background: linear-gradient(135deg, #4338CA, #6366F1); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-newspaper" style="font-size: 40px; color: rgba(255,255,255,0.3);"></i>
                            </div>
                        @endif
                        <div class="post-card-body">
                            <div class="post-card-meta mb-2">
                                <i class="fas fa-calendar me-1"></i> {{ $post->fecha_publicacion?->format('d M Y') }}
                            </div>
                            <h3><a href="{{ route('blog.show', $post) }}">{{ $post->titulo }}</a></h3>
                            <p>{{ Str::limit($post->extracto ?? strip_tags($post->contenido), 120) }}</p>
                            <a href="{{ route('blog.show', $post) }}" style="color: var(--primary); font-size: 14px; font-weight: 600; text-decoration: none;">
                                Leer más <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-4">{{ $posts->links() }}</div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-newspaper fa-3x mb-3" style="color: #94A3B8;"></i>
                <h3 style="color: #64748B;">Próximamente</h3>
                <p class="text-muted">Estamos preparando contenido interesante para ti.</p>
                <a href="{{ route('home') }}" style="color: var(--primary); font-weight: 600;">Volver al inicio</a>
            </div>
            @endif
        </div>
    </section>
@endsection
