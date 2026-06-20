@props(['type' => 'WebPage', 'name' => null, 'items' => []])

@php
    $_seoSettings = $_globalSettings ?? [];
    $_siteName = $_seoSettings['site_name'] ?? 'Pusat Furniture Cafe dan Resto';
    $_siteDesc = $_seoSettings['site_description'] ?? 'Pusat Furniture Cafe dan Resto - Penyedia furnitur berkualitas untuk cafe, restoran, coffee shop, dan usaha kuliner.';
    $_logoUrl = $_globalLogo ?? asset('images/logo.png');
    $_wa = $_seoSettings['whatsapp_number'] ?? '6281234567890';
    $_fb = $_seoSettings['facebook_url'] ?? 'https://facebook.com/pusatfurniturecafe';
    $_ig = $_seoSettings['instagram_url'] ?? 'https://instagram.com/pusatfurniturecafe';
    $_addr = $_seoSettings['address'] ?? '';
    $_phone = $_seoSettings['phone'] ?? '+62-812-3456-7890';
@endphp

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "{{ $type }}",
    "name": "{{ $name ?? $_siteName }}",
    "url": "{{ url()->current() }}",
    @if ($type === 'Organization')
    "logo": "{{ $_logoUrl }}",
    "description": "{{ $_siteDesc }}",
    "address": "{{ $_addr }}",
    "telephone": "{{ $_phone }}",
    "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+{{ $_wa }}",
        "contactType": "customer service"
    },
    "sameAs": [
        "{{ $_fb }}",
        "{{ $_ig }}"
    ]
    @endif
    @if (!empty($items))
    ,"itemListElement": {!! json_encode($items) !!}
    @endif
}
</script>
