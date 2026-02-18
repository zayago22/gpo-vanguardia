{{-- Componente: Schema LocalBusiness --}}
@php $company = \App\Helpers\SeoHelper::company() ?? []; @endphp
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "{{ data_get($company, 'legal_name', '') }}",
  "description": "{{ data_get($company, 'description', '') }}",
  "telephone": "{{ data_get($company, 'phone', '') }}",
  "email": "{{ data_get($company, 'email', '') }}",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "{{ data_get($company, 'address.street', '') }}",
    "addressLocality": "{{ data_get($company, 'address.city', '') }}",
    "addressRegion": "{{ data_get($company, 'address.region', '') }}",
    "postalCode": "{{ data_get($company, 'address.zip', '') }}",
    "addressCountry": "{{ data_get($company, 'address.country', '') }}"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": {{ data_get($company, 'geo.latitude', 0) }},
    "longitude": {{ data_get($company, 'geo.longitude', 0) }}
  },
  "openingHours": "Mo-Fr {{ data_get($company, 'opening_hours.opens', '08:00') }}-{{ data_get($company, 'opening_hours.closes', '18:00') }}"
}
</script>
