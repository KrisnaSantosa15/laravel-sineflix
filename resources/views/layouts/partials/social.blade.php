{{-- <!-- Twitter -->
<meta name="twitter:card" content="{{ $isHome ? 'summary_large_image' : 'summary' }}">
<meta name="twitter:site" content="{{ $siteParams['twitter'] }}">
<meta name="twitter:creator" content="{{ $siteParams['twitter'] }}">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $pageParams['description'] ?? $siteParams['description'] }}">
<meta name="twitter:image"
    content="{{ $isHome ? asset($siteParams['social_logo_path']) : asset($siteParams['social_image_path']) }}">

<!-- Facebook -->
<meta property="og:url" content="{{ $permalink }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $pageParams['description'] ?? $siteParams['description'] }}">
<meta property="og:type" content="{{ $isPage ? 'article' : 'website' }}">
<meta property="og:image" content="{{ asset($siteParams['social_image_path']) }}">
<meta property="og:image:type" content="image/png"> --}}
