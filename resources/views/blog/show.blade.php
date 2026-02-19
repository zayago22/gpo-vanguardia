@extends('layouts.public')

@section('title', $post->titulo . ' — GPO Vanguardia')
@section('description', $post->meta_description ?: Str::limit(strip_tags($post->extracto ?: $post->contenido), 155))
@section('og_type', 'article')
@if($post->imagen_portada)
@section('og_image', asset('storage/' . $post->imagen_portada))
@endif

@section('seo_extra')
{{-- BlogPosting Schema.org --}}
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BlogPosting",
  "headline": "{{ $post->titulo }}",
  "description": "{{ $post->meta_description ?: Str::limit(strip_tags($post->extracto ?: $post->contenido), 155) }}",
  @if($post->imagen_portada)
  "image": "{{ asset('storage/' . $post->imagen_portada) }}",
  @endif
  "datePublished": "{{ $post->fecha_publicacion->toIso8601String() }}",
  "dateModified": "{{ $post->updated_at->toIso8601String() }}",
  "author": {
    "@@type": "Organization",
    "name": "{{ config('seo.site_name') }}",
    "url": "{{ config('seo.site_url') }}"
  },
  "publisher": {
    "@@type": "Organization",
    "name": "{{ config('seo.site_name') }}",
    "logo": {
      "@@type": "ImageObject",
      "url": "{{ config('seo.site_url') }}/images/logo.png"
    }
  },
  "mainEntityOfPage": {
    "@@type": "WebPage",
    "@@id": "{{ url()->current() }}"
  },
  "url": "{{ route('blog.show', $post) }}"
}
</script>
{{-- BreadcrumbList --}}
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BreadcrumbList",
  "itemListElement": [
    {"@@type": "ListItem", "position": 1, "name": "Inicio", "item": "{{ route('home') }}"},
    {"@@type": "ListItem", "position": 2, "name": "Blog", "item": "{{ route('blog.index') }}"},
    {"@@type": "ListItem", "position": 3, "name": "{{ $post->titulo }}"}
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
        
        /* Hero del Post */
        .post-header {
            background: url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=1600&h=600&fit=crop') center/cover no-repeat;
            padding: 120px 0 80px;
            margin-top: 70px;
            position: relative;
        }
        .post-header::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(67,56,202,0.92) 0%, rgba(99,102,241,0.88) 100%);
        }
        .post-header .container { position: relative; z-index: 2; }
        .post-header .back-link {
            color: rgba(255,255,255,0.7);
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(255,255,255,0.1);
            border-radius: 50px;
            transition: all 0.3s;
            margin-bottom: 24px;
        }
        .post-header .back-link:hover {
            background: rgba(255,255,255,0.2);
            color: #fff;
        }
        .post-header h1 { 
            color: #fff; 
            font-size: 42px; 
            font-weight: 800; 
            max-width: 800px;
            line-height: 1.2;
            letter-spacing: -0.5px;
            margin-bottom: 20px;
        }
        .post-header .meta {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: center;
        }
        .post-header .meta span {
            color: rgba(255,255,255,0.8);
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .post-header .meta i { color: rgba(255,255,255,0.6); }
        
        /* Contenido del Post */
        .post-content {
            padding: 60px 0 80px;
            background: var(--white);
        }
        .post-image {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            margin-bottom: 40px;
            margin-top: -60px;
            position: relative;
            z-index: 3;
        }
        .post-image img {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
        }
        .content-body { 
            font-size: 17px; 
            line-height: 1.9; 
            color: var(--gray-600); 
            max-width: 750px;
            margin: 0 auto;
        }
        .content-body p { margin-bottom: 20px; }
        .content-body h2, .content-body h3, .content-body h4 {
            color: var(--dark);
            font-weight: 700;
            margin-top: 32px;
            margin-bottom: 16px;
        }
        .content-body h2 { font-size: 28px; }
        .content-body h3 { font-size: 22px; }
        .content-body h4 { font-size: 18px; }
        .content-body h5 { font-size: 16px; font-weight: 600; color: var(--dark); margin-top: 24px; margin-bottom: 12px; }
        .content-body ul, .content-body ol {
            margin-bottom: 20px;
            padding-left: 28px;
        }
        .content-body li { margin-bottom: 8px; }
        .content-body blockquote {
            border-left: 4px solid var(--primary);
            padding: 16px 24px;
            margin: 24px 0;
            background: var(--gray-50);
            border-radius: 0 8px 8px 0;
            font-style: italic;
            color: var(--gray-600);
        }
        .content-body a { color: var(--primary); text-decoration: underline; transition: color 0.3s; }
        .content-body a:hover { color: var(--primary-dark); }
        .content-body img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin: 20px 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .content-body table {
            width: 100%;
            border-collapse: collapse;
            margin: 24px 0;
            border-radius: 8px;
            overflow: hidden;
        }
        .content-body table th, .content-body table td {
            padding: 12px 16px;
            border: 1px solid var(--gray-200);
            text-align: left;
        }
        .content-body table th {
            background: var(--gray-100);
            font-weight: 600;
            color: var(--dark);
        }
        .content-body table tr:hover { background: var(--gray-50); }
        .content-body hr {
            border: none;
            border-top: 2px solid var(--gray-200);
            margin: 32px 0;
        }
        .content-body pre, .content-body code {
            background: var(--gray-100);
            border-radius: 6px;
            font-size: 14px;
        }
        .content-body code { padding: 2px 6px; }
        .content-body pre { padding: 16px; overflow-x: auto; margin: 20px 0; }
        .content-body pre code { padding: 0; background: transparent; }
        
        /* Compartir */
        .share-section {
            padding: 30px 0;
            border-top: 1px solid var(--gray-200);
            margin-top: 40px;
        }
        .share-section h5 {
            font-size: 14px;
            font-weight: 600;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
        }
        .share-buttons {
            display: flex;
            gap: 12px;
        }
        .share-btn {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 18px;
            text-decoration: none;
            transition: all 0.3s;
        }
        .share-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        .share-btn.facebook { background: #1877F2; }
        .share-btn.twitter { background: #1DA1F2; }
        .share-btn.linkedin { background: #0A66C2; }
        .share-btn.whatsapp { background: #25D366; }
        
        /* Artículos Relacionados */
        .related-section {
            padding: 80px 0;
            background: var(--gray-50);
        }
        .related-section h3 {
            font-size: 28px;
            font-weight: 700;
            color: var(--dark);
            text-align: center;
            margin-bottom: 40px;
        }
        .related-section h3::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--primary);
            margin: 14px auto 0;
            border-radius: 2px;
        }
        .related-card { 
            background: var(--white); 
            border-radius: 16px; 
            overflow: hidden; 
            border: 1px solid var(--gray-200); 
            transition: all 0.3s;
            height: 100%;
        }
        .related-card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 12px 35px rgba(67,56,202,0.1);
            border-color: rgba(67,56,202,0.2);
        }
        .related-card-img {
            position: relative;
            overflow: hidden;
        }
        .related-card-img img { 
            width: 100%; 
            height: 180px; 
            object-fit: cover;
            transition: transform 0.4s;
        }
        .related-card:hover .related-card-img img {
            transform: scale(1.05);
        }
        .related-card-placeholder {
            width: 100%; 
            height: 180px; 
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .related-card-placeholder i {
            font-size: 36px;
            color: rgba(255,255,255,0.25);
        }
        .related-card-body { padding: 20px; }
        .related-card-body h5 { 
            font-size: 17px; 
            font-weight: 700; 
            color: var(--dark);
            margin-bottom: 8px;
            line-height: 1.4;
        }
        .related-card-body h5 a { 
            color: inherit; 
            text-decoration: none;
            transition: color 0.3s;
        }
        .related-card-body h5 a:hover { color: var(--primary); }
        .related-card-body small {
            color: var(--gray-400);
            font-size: 13px;
        }
        
        /* Responsive */
        @media (max-width: 991px) {
            .post-header { padding: 100px 0 60px; }
            .post-header h1 { font-size: 32px; }
            .post-content { padding: 40px 0 60px; }
            .post-image { margin-top: -40px; }
        }
        @media (max-width: 767px) {
            .post-header h1 { font-size: 26px; }
            .content-body { font-size: 16px; }
            .related-section { padding: 60px 0; }
        }
    </style>
@endsection

@section('content')
    <!-- Hero del Post -->
    <section class="post-header">
        <div class="container">
            <a href="{{ route('blog.index') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Volver al Blog
            </a>
            <h1>{{ $post->titulo }}</h1>
            <div class="meta">
                <span><i class="fas fa-calendar-alt"></i> {{ $post->fecha_publicacion?->format('d M Y') }}</span>
                @if($post->user)
                    <span><i class="fas fa-user"></i> {{ $post->user->name }}</span>
                @endif
                @if($post->categoria)
                    <span><i class="fas fa-folder"></i> {{ $post->categoria }}</span>
                @endif
            </div>
        </div>
    </section>

    <!-- Contenido del Post -->
    <section class="post-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    @if($post->imagen_portada)
                        <div class="post-image">
                            <img src="{{ asset('storage/' . $post->imagen_portada) }}" alt="{{ $post->titulo }}">
                        </div>
                    @endif
                    <div class="content-body">
                        {!! $post->contenido !!}
                    </div>
                    
                    <!-- Compartir -->
                    <div class="share-section">
                        <h5>Compartir artículo</h5>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="share-btn facebook" title="Compartir en Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->titulo) }}" target="_blank" class="share-btn twitter" title="Compartir en Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($post->titulo) }}" target="_blank" class="share-btn linkedin" title="Compartir en LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($post->titulo . ' ' . request()->url()) }}" target="_blank" class="share-btn whatsapp" title="Compartir en WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Artículos Relacionados -->
    @if($related->count() > 0)
    <section class="related-section">
        <div class="container">
            <h3>Artículos Relacionados</h3>
            <div class="row g-4">
                @foreach($related as $rel)
                <div class="col-lg-4 col-md-6">
                    <div class="related-card">
                        <a href="{{ route('blog.show', $rel) }}" class="related-card-img" style="display:block;text-decoration:none;">
                            @if($rel->imagen_portada)
                                <img src="{{ asset('storage/' . $rel->imagen_portada) }}" alt="{{ $rel->titulo }}">
                            @else
                                <div class="related-card-placeholder">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                            @endif
                        </a>
                        <div class="related-card-body">
                            <h5><a href="{{ route('blog.show', $rel) }}">{{ $rel->titulo }}</a></h5>
                            <small><i class="fas fa-calendar-alt me-1"></i> {{ $rel->fecha_publicacion?->format('d M Y') }}</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection
