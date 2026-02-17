<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog — GPO Vanguardia</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --primary: #4338CA; --primary-light: #6366F1; --dark: #1E1B4B; }
        body { font-family: 'Montserrat', sans-serif; color: #334155; }
        .navbar-blog { background: var(--dark); padding: 14px 0; }
        .navbar-blog .navbar-brand img { height: 36px; }
        .navbar-blog .nav-link { color: rgba(255,255,255,0.8) !important; font-size: 14px; font-weight: 500; }
        .navbar-blog .nav-link:hover { color: #fff !important; }
        .blog-hero { background: linear-gradient(135deg, var(--primary), var(--primary-light)); padding: 80px 0 50px; text-align: center; }
        .blog-hero h1 { color: #fff; font-size: 36px; font-weight: 800; }
        .blog-hero p { color: rgba(255,255,255,0.8); font-size: 16px; }
        .post-card { background: #fff; border-radius: 14px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.06); border: 1px solid #E2E8F0; transition: all 0.3s; }
        .post-card:hover { transform: translateY(-4px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
        .post-card img { width: 100%; height: 200px; object-fit: cover; }
        .post-card-body { padding: 20px; }
        .post-card-body h3 { font-size: 18px; font-weight: 700; color: var(--dark); margin-bottom: 8px; }
        .post-card-body h3 a { color: inherit; text-decoration: none; }
        .post-card-body h3 a:hover { color: var(--primary); }
        .post-card-body p { font-size: 14px; color: #64748B; line-height: 1.6; }
        .post-card-meta { font-size: 12px; color: #94A3B8; }
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
                    <li class="nav-item"><a class="nav-link active" href="{{ route('blog.index') }}">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#contacto">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>

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
