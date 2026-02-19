{{-- SEO Head Partial for standalone pages --}}
@php
    $seoPage = $seoPage ?? null;
    $seoMeta = $seoMeta ?? [];
    $meta = \App\Helpers\SeoHelper::meta($seoPage, $seoMeta);
    $company = \App\Helpers\SeoHelper::company();
    $siteUrl = config('seo.site_url');
    $siteName = config('seo.site_name');
    $socialLinks = array_values(array_filter(data_get($company, 'social', [])));
@endphp
<link rel="canonical" href="{{ $meta['canonical'] ?? url()->current() }}">
<meta name="robots" content="{{ $meta['robots'] ?? 'index, follow' }}">
<meta name="author" content="{{ $siteName }}">

{{-- Open Graph --}}
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="es_MX">
<meta property="og:title" content="{{ $meta['title'] ?? '' }}">
<meta property="og:description" content="{{ $meta['meta_description'] ?? '' }}">
<meta property="og:image" content="{{ $meta['og_image'] ?? ($siteUrl . '/images/logo.png') }}">
<meta property="og:type" content="{{ $meta['og_type'] ?? 'website' }}">
<meta property="og:url" content="{{ $meta['canonical'] ?? url()->current() }}">

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $meta['title'] ?? '' }}">
<meta name="twitter:description" content="{{ $meta['meta_description'] ?? '' }}">
<meta name="twitter:image" content="{{ $meta['og_image'] ?? ($siteUrl . '/images/logo.png') }}">

{{-- Schema.org Organization --}}
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "Organization",
  "name": "{{ data_get($company, 'legal_name', '') }}",
  "url": "{{ $siteUrl }}",
  "logo": "{{ $siteUrl }}/images/logo.png",
  "description": "{{ data_get($company, 'description', '') }}",
  "telephone": "{{ data_get($company, 'phone', '') }}",
  "email": "{{ data_get($company, 'email', '') }}",
  "address": {
    "@@type": "PostalAddress",
    "streetAddress": "{{ data_get($company, 'address.street', '') }}",
    "addressLocality": "{{ data_get($company, 'address.city', '') }}",
    "addressRegion": "{{ data_get($company, 'address.region', '') }}",
    "postalCode": "{{ data_get($company, 'address.zip', '') }}",
    "addressCountry": "{{ data_get($company, 'address.country', '') }}"
  },
  "sameAs": {!! json_encode($socialLinks) !!}
}
</script>

{{-- Schema.org LocalBusiness --}}
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "LocalBusiness",
  "name": "{{ data_get($company, 'legal_name', '') }}",
  "description": "{{ data_get($company, 'description', '') }}",
  "telephone": "{{ data_get($company, 'phone', '') }}",
  "email": "{{ data_get($company, 'email', '') }}",
  "url": "{{ $siteUrl }}",
  "image": "{{ $siteUrl }}/images/logo.png",
  "priceRange": "$$",
  "address": {
    "@@type": "PostalAddress",
    "streetAddress": "{{ data_get($company, 'address.street', '') }}",
    "addressLocality": "{{ data_get($company, 'address.city', '') }}",
    "addressRegion": "{{ data_get($company, 'address.region', '') }}",
    "postalCode": "{{ data_get($company, 'address.zip', '') }}",
    "addressCountry": "{{ data_get($company, 'address.country', '') }}"
  },
  "geo": {
    "@@type": "GeoCoordinates",
    "latitude": {{ data_get($company, 'geo.latitude', 0) }},
    "longitude": {{ data_get($company, 'geo.longitude', 0) }}
  },
  "openingHoursSpecification": {
    "@@type": "OpeningHoursSpecification",
    "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"],
    "opens": "{{ data_get($company, 'opening_hours.opens', '08:00') }}",
    "closes": "{{ data_get($company, 'opening_hours.closes', '18:00') }}"
  }
}
</script>
