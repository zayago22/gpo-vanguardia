{{-- Componente: Schema Organization --}}
@php $company = \App\Helpers\SeoHelper::company() ?? []; @endphp
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "{{ data_get($company, 'legal_name', '') }}",
  "url": "{{ config('seo.site_url') }}",
  "logo": "{{ config('seo.site_url') }}/img/logo.png",
  "contactPoint": [{
    "@type": "ContactPoint",
    "telephone": "{{ data_get($company, 'phone', '') }}",
    "contactType": "customer service",
    "areaServed": "MX",
    "availableLanguage": ["Spanish"]
  }],
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "{{ data_get($company, 'address.street', '') }}",
    "addressLocality": "{{ data_get($company, 'address.city', '') }}",
    "addressRegion": "{{ data_get($company, 'address.region', '') }}",
    "postalCode": "{{ data_get($company, 'address.zip', '') }}",
    "addressCountry": "{{ data_get($company, 'address.country', '') }}"
  }
}
</script>
