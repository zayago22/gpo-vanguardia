{{-- Componente: SEO Meta Tags --}}
@php
    $meta = $meta ?? [];
    $siteUrl = config('seo.site_url');
    $siteName = config('seo.site_name');
@endphp
<title>{{ $meta['title'] ?? config('seo.defaults.title') }}</title>
<meta name="description" content="{{ $meta['meta_description'] ?? config('seo.defaults.meta_description') }}">
<meta name="keywords" content="{{ $meta['meta_keywords'] ?? config('seo.defaults.meta_keywords') }}">
<meta name="robots" content="{{ $meta['robots'] ?? config('seo.defaults.robots') }}">
<link rel="canonical" href="{{ $meta['canonical'] ?? url()->current() }}">

{{-- Open Graph --}}
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="es_MX">
<meta property="og:title" content="{{ $meta['title'] ?? config('seo.defaults.title') }}">
<meta property="og:description" content="{{ $meta['meta_description'] ?? config('seo.defaults.meta_description') }}">
<meta property="og:image" content="{{ $meta['og_image'] ?? ($siteUrl . config('seo.defaults.og_image')) }}">
<meta property="og:type" content="{{ $meta['og_type'] ?? 'website' }}">
<meta property="og:url" content="{{ $meta['canonical'] ?? url()->current() }}">

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $meta['title'] ?? config('seo.defaults.title') }}">
<meta name="twitter:description" content="{{ $meta['meta_description'] ?? config('seo.defaults.meta_description') }}">
<meta name="twitter:image" content="{{ $meta['og_image'] ?? ($siteUrl . config('seo.defaults.og_image')) }}">
