@extends('layouts.public')

@section('title', 'Blog — GPO Vanguardia')
@section('description', config('seo.pages.blog.meta_description', 'Artículos sobre contact center, BPO, inteligencia artificial y tecnología.'))

@section('seo_extra')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BreadcrumbList",
  "itemListElement": [
    {"@@type": "ListItem", "position": 1, "name": "Inicio", "item": "{{ route('home') }}"},
    {"@@type": "ListItem", "position": 2, "name": "Blog"}
  ]
}
</script>
@endsection

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
        
        /* Hero del Blog */
        .blog-hero {
            background: url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=1600&h=600&fit=crop') center/cover no-repeat;
            padding: 120px 0 80px;
            text-align: center;
            margin-top: 70px;
            position: relative;
        }
        .blog-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(67,56,202,0.92) 0%, rgba(99,102,241,0.88) 100%);
        }
        .blog-hero .container { position: relative; z-index: 2; }
        .blog-hero h1 { 
            color: #fff; 
            font-size: 48px; 
            font-weight: 800; 
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }
        .blog-hero p { 
            color: rgba(255,255,255,0.85); 
            font-size: 18px; 
            max-width: 600px;
            margin: 0 auto;
        }
        
        /* Sección de Posts */
        .blog-section {
            padding: 80px 0;
            background: var(--gray-50);
            min-height: 60vh;
        }
        .filters-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 14px;
            padding: 18px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.04);
            margin-bottom: 28px;
        }
        .filters-card h5 {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 14px;
        }
        .filters-card label {
            font-size: 13px;
            color: var(--gray-600);
            font-weight: 600;
            margin-bottom: 6px;
        }
        .filters-card .form-control,
        .filters-card .form-select {
            border-radius: 10px;
            border-color: var(--gray-200);
            font-size: 14px;
        }
        .filters-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .btn-filter {
            background: var(--gradient);
            color: var(--white);
            border: none;
            padding: 10px 16px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }
        .btn-filter:hover { color: var(--white); opacity: 0.95; }
        .btn-clear {
            color: var(--gray-500);
            font-size: 13px;
            text-decoration: none;
        }
        .btn-clear:hover { color: var(--primary); }
        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }
        .section-header h2 {
            font-size: 32px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
        }
        .section-header h2::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--primary);
            margin: 14px auto 0;
            border-radius: 2px;
        }
        .section-header p {
            color: var(--gray-500);
            font-size: 16px;
        }
        
        /* Cards de Posts */
        .post-card { 
            background: var(--white); 
            border-radius: 16px; 
            overflow: hidden; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.06); 
            border: 1px solid var(--gray-200); 
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .post-card:hover { 
            transform: translateY(-6px); 
            box-shadow: 0 12px 35px rgba(67,56,202,0.12);
            border-color: rgba(67,56,202,0.2);
        }
        .post-card-img {
            position: relative;
            overflow: hidden;
        }
        .post-card-img img { 
            width: 100%; 
            height: 220px; 
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .post-card:hover .post-card-img img {
            transform: scale(1.05);
        }
        .post-card-placeholder {
            width: 100%; 
            height: 220px; 
            background: var(--gradient);
            display: flex; 
            align-items: center; 
            justify-content: center;
        }
        .post-card-placeholder i {
            font-size: 48px; 
            color: rgba(255,255,255,0.25);
        }
        .post-card-body { 
            padding: 24px; 
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .post-card-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }
        .post-card-meta span {
            font-size: 12px;
            color: var(--gray-400);
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .post-card-meta i {
            color: var(--primary-light);
        }
        .post-card-body h3 { 
            font-size: 20px; 
            font-weight: 700; 
            color: var(--dark); 
            margin-bottom: 12px;
            line-height: 1.4;
        }
        .post-card-body h3 a { 
            color: inherit; 
            text-decoration: none;
            transition: color 0.3s;
        }
        .post-card-body h3 a:hover { color: var(--primary); }
        .post-card-body p { 
            font-size: 14px; 
            color: var(--gray-500); 
            line-height: 1.7;
            flex: 1;
            margin-bottom: 16px;
        }
        .post-card-link {
            color: var(--primary); 
            font-size: 14px; 
            font-weight: 600; 
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: gap 0.3s;
        }
        .post-card-link:hover {
            gap: 10px;
            color: var(--primary-dark);
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        }
        .empty-state-icon {
            width: 100px;
            height: 100px;
            background: var(--gray-100);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
        }
        .empty-state-icon i {
            font-size: 40px;
            color: var(--gray-400);
        }
        .empty-state h3 {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 12px;
        }
        .empty-state p {
            color: var(--gray-500);
            font-size: 16px;
            margin-bottom: 24px;
        }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--gradient);
            color: var(--white);
            padding: 14px 28px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s;
        }
        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(67,56,202,0.3);
            color: var(--white);
        }
        
        /* Responsive */
        @media (max-width: 991px) {
            .blog-hero { padding: 100px 0 60px; }
            .blog-hero h1 { font-size: 36px; }
            .blog-section { padding: 60px 0; }
        }
        @media (max-width: 767px) {
            .blog-hero h1 { font-size: 28px; }
            .blog-hero p { font-size: 15px; }
            .section-header h2 { font-size: 26px; }
        }
    </style>
@endsection

@section('content')
    <!-- Hero del Blog -->
    <section class="blog-hero">
        <div class="container">
            <h1>Nuestro Blog</h1>
            <p>Artículos, noticias y actualizaciones sobre tecnología, BPO y transformación digital</p>
        </div>
    </section>

    <!-- Sección de Posts -->
    <section class="blog-section">
        <div class="container">
            <div class="filters-card">
                <form method="GET" action="{{ route('blog.index') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-lg-3 col-md-6">
                            <label class="form-label">Categoría</label>
                            <select name="categoria" class="form-select">
                                <option value="">Todas</option>
                                @foreach(($categorias ?? collect()) as $categoria)
                                    <option value="{{ $categoria }}" {{ request('categoria') === $categoria ? 'selected' : '' }}>{{ $categoria }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <label class="form-label">Buscar</label>
                            <input type="text" name="q" class="form-control" placeholder="Buscar por título, extracto o contenido" value="{{ request('q') }}">
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label">Desde</label>
                            <input type="date" name="desde" class="form-control" value="{{ request('desde') }}">
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label">Hasta</label>
                            <input type="date" name="hasta" class="form-control" value="{{ request('hasta') }}">
                        </div>
                        <div class="col-lg-1 col-md-12 filters-actions">
                            <button type="submit" class="btn-filter w-100"><i class="fas fa-filter"></i> Filtrar</button>
                        </div>
                    </div>
                    @if(request()->hasAny(['categoria','q','desde','hasta']) && filled(request('categoria') ?? request('q') ?? request('desde') ?? request('hasta')))
                    <div class="mt-2 text-end">
                        <a class="btn-clear" href="{{ route('blog.index') }}">Limpiar filtros</a>
                    </div>
                    @endif
                </form>
            </div>
            @if($posts->count() > 0)
                <div class="section-header">
                    <h2>Últimos Artículos</h2>
                    <p>Mantente informado con nuestras publicaciones más recientes</p>
                </div>
                <div class="row g-4">
                    @foreach($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="post-card">
                            <a href="{{ route('blog.show', $post) }}" class="post-card-img" style="display:block;text-decoration:none;">
                                @if($post->imagen_portada)
                                    <img src="{{ asset('storage/' . $post->imagen_portada) }}" alt="{{ $post->titulo }}">
                                @else
                                    <div class="post-card-placeholder">
                                        <i class="fas fa-newspaper"></i>
                                    </div>
                                @endif
                            </a>
                            <div class="post-card-body">
                                <div class="post-card-meta">
                                    <span><i class="fas fa-calendar-alt"></i> {{ $post->fecha_publicacion?->format('d M Y') }}</span>
                                    @if($post->categoria)
                                        <span><i class="fas fa-folder"></i> {{ $post->categoria }}</span>
                                    @endif
                                </div>
                                <h3><a href="{{ route('blog.show', $post) }}">{{ $post->titulo }}</a></h3>
                                <p>{{ Str::limit($post->extracto ?? strip_tags($post->contenido), 120) }}</p>
                                <a href="{{ route('blog.show', $post) }}" class="post-card-link">
                                    Leer artículo <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-5 d-flex justify-content-center">{{ $posts->links() }}</div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-feather-alt"></i>
                    </div>
                    <h3>Próximamente</h3>
                    <p>Estamos preparando contenido interesante para ti.<br>¡Vuelve pronto!</p>
                    <a href="{{ route('home') }}" class="btn-back">
                        <i class="fas fa-home"></i> Volver al inicio
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
