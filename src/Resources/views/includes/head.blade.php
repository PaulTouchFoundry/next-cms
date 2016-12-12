<meta charset="utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<?php
    $brandTitle = config('cms.brand.title') . " | ";
?>
<title>{{ $brandTitle }}@yield('title')</title>
<meta name="description" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<!-- Open Graph -->
<meta property="og:locale" content="en_GB" />
<meta property="og:title" content="{{ $brandTitle }}@yield('title')" />
<meta property="og:description" content="" />
<meta property="og:url" content="{{ url('/') }}" />
<meta property="og:image" content="" />

<!-- Twitter Card -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="{{ url('/') }}" />
<meta name="twitter:title" content="{{ $brandTitle }}@yield('title')" />
<meta name="twitter:description" content="" />
<meta name="twitter:image" content="" />

<!-- Apple Touch Icon -->
<link rel="apple-touch-icon" href="{{ url('/apple-touch-icon.png') }}" />

<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,600,400" />

<!-- Style Sheets -->

<link rel="stylesheet" href="{{ url('/vendor/cms/css/style-dfeddee.css') }}" />


<!--[if lt IE 9]>
<script src="{{ url('assets/js/vendor/polyfills.js') }}"></script>
<![endif]-->
