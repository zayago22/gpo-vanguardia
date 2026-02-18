@extends('layouts.public')

@section('title', $post->titulo . ' — GPO Vanguardia')

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
        .post-header { background: var(--gradient); padding: 80px 0 50px; margin-top: 70px; }
        .post-header h1 { color: #fff; font-size: 32px; font-weight: 800; max-width: 700px; }
        .post-header .meta { color: rgba(255,255,255,0.7); font-size: 14px; }
        .post-content { padding: 50px 0; }
        .post-content .content-body { font-size: 16px; line-height: 1.9; color: var(--gray-600); max-width: 750px; }
        .post-content .content-body p { margin-bottom: 18px; }
        .related-card { background: var(--white); border-radius: 12px; overflow: hidden; border: 1px solid var(--gray-200); transition: all 0.3s; }
        .related-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,0.08); }
        .related-card img { width: 100%; height: 160px; object-fit: cover; }
        .related-card-body { padding: 16px; }
        .related-card-body h5 { font-size: 15px; font-weight: 700; color: var(--dark); }
        .related-card-body h5 a { color: inherit; text-decoration: none; }
    </style>
@endsection

@section('content')
    <section class="post-header">
        <div class="container">
            <a href="{{ route('blog.index') }}" style="color: rgba(255,255,255,0.6); font-size: 14px; text-decoration: none;">
                <i class="fas fa-arrow-left me-1"></i> Volver al Blog
            </a>
            <h1 class="mt-3">{{ $post->titulo }}</h1>
            <div class="meta mt-2">
                <i class="fas fa-calendar me-1"></i> {{ $post->fecha_publicacion?->format('d M Y') }}
                @if($post->user)
                    <span class="ms-3"><i class="fas fa-user me-1"></i> {{ $post->user->name }}</span>
                @endif
            </div>
        </div>
    </section>

    <section class="post-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    @if($post->imagen_portada)
                        <img src="{{ asset('storage/' . $post->imagen_portada) }}" class="rounded mb-4" style="width: 100%; max-height: 400px; object-fit: cover;">
                    @endif
                    <div class="content-body">
                        {!! nl2br(e($post->contenido)) !!}
                    </div>
                </div>
            </div>

            @if($related->count() > 0)
            <hr class="my-5">
            <h3 style="font-size: 22px; font-weight: 700; color: var(--dark); margin-bottom: 20px;">Artículos relacionados</h3>
            <div class="row g-4">
                @foreach($related as $rel)
                <div class="col-md-4">
                    <div class="related-card">
                        @if($rel->imagen_portada)
                            <img src="{{ asset('storage/' . $rel->imagen_portada) }}" alt="{{ $rel->titulo }}">
                        @else
                            <div style="width: 100%; height: 160px; background: linear-gradient(135deg, #4338CA, #6366F1); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-newspaper" style="font-size: 30px; color: rgba(255,255,255,0.3);"></i>
                            </div>
                        @endif
                        <div class="related-card-body">
                            <h5><a href="{{ route('blog.show', $rel) }}">{{ $rel->titulo }}</a></h5>
                            <small class="text-muted">{{ $rel->fecha_publicacion?->format('d M Y') }}</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
@endsection
