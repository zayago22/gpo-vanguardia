{{-- Componente: SEO Meta Tags --}}
@php
    $meta = $meta ?? [];
@endphp
<title>{{ $meta['title'] ?? config('seo.defaults.title') }}</title>
<meta name="description" content="{{ $meta['meta_description'] ?? config('seo.defaults.meta_description') }}">
<meta name="keywords" content="{{ $meta['meta_keywords'] ?? config('seo.defaults.meta_keywords') }}">
<meta property="og:title" content="{{ $meta['title'] ?? config('seo.defaults.title') }}">
<meta property="og:description" content="{{ $meta['meta_description'] ?? config('seo.defaults.meta_description') }}">
<meta property="og:image" content="{{ $meta['og_image'] ?? config('seo.defaults.og_image') }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta name="robots" content="{{ $meta['robots'] ?? config('seo.defaults.robots') }}">
