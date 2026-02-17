<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->titulo }} — GPO Vanguardia</title>
    <meta name="description" content="{{ Str::limit($post->extracto ?? strip_tags($post->contenido), 160) }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --primary: #4338CA; --primary-light: #6366F1; --dark: #1E1B4B; }
        body { font-family: 'Inter', sans-serif; color: #334155; }
        .navbar-blog { background: var(--dark); padding: 14px 0; }
        .navbar-blog .navbar-brand img { height: 36px; }
        .navbar-blog .nav-link { color: rgba(255,255,255,0.8) !important; font-size: 14px; font-weight: 500; }
        .post-header { background: linear-gradient(135deg, var(--primary), var(--primary-light)); padding: 80px 0 50px; }
        .post-header h1 { color: #fff; font-size: 32px; font-weight: 800; max-width: 700px; }
        .post-header .meta { color: rgba(255,255,255,0.7); font-size: 14px; }
        .post-content { padding: 50px 0; }
        .post-content .content-body { font-size: 16px; line-height: 1.9; color: #475569; max-width: 750px; }
        .post-content .content-body p { margin-bottom: 18px; }
        .related-card { background: #fff; border-radius: 12px; overflow: hidden; border: 1px solid #E2E8F0; transition: all 0.3s; }
        .related-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,0.08); }
        .related-card img { width: 100%; height: 160px; object-fit: cover; }
        .related-card-body { padding: 16px; }
        .related-card-body h5 { font-size: 15px; font-weight: 700; color: var(--dark); }
        .related-card-body h5 a { color: inherit; text-decoration: none; }
        .footer-blog { background: var(--dark); padding: 24px 0; text-align: center; }
        .footer-blog p { color: rgba(255,255,255,0.5); font-size: 13px; margin: 0; }
        .footer-blog a { color: rgba(255,255,255,0.7); margin: 0 8px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-blog">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt="GPO Vanguardia"></a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('blog.index') }}">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#contacto">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>

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

    <footer class="footer-blog">
        <div class="container">
            @if($redes->count() > 0)
            <div class="mb-2">
                @foreach($redes as $red)
                    <a href="{{ $red->url }}" target="_blank"><i class="{{ $red->icono }}"></i></a>
                @endforeach
            </div>
            @endif
            <p>&copy; {{ date('Y') }} Grupo Vanguardia. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
