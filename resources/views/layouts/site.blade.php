@php use App\Models\SiteSetting as S; @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ S::get('meta_title') }}</title>
    <meta name="description" content="{{ S::get('meta_description') }}">
    <link rel="icon" href="{{ S::image('favicon') }}">
    <meta name="theme-color" content="{{ S::get('color_bg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}?v={{ filemtime(public_path('css/site.css')) }}">
    <style>
        :root {
            --bg: {{ S::get('color_bg') }};
            --surface: {{ S::get('color_surface') }};
            --accent: {{ S::get('color_accent') }};
            --line: {{ S::get('color_line') }};
            --heading: {{ S::get('color_heading') }};
            --text: {{ S::get('color_text') }};
        }
    </style>
</head>
<body>
<header class="site-header" id="top">
    <div class="header-inner">
        <a href="{{ route('home') }}" class="brand" aria-label="{{ S::get('brand_name') }}">
            @if($logo = S::image('logo'))
                <img class="brand-mark" src="{{ $logo }}" alt="">
            @endif
            <span class="brand-text">
                <span class="brand-name">{{ S::get('brand_name') }},<span class="brand-cred"> {{ S::get('brand_credentials') }}</span></span>
                <span class="brand-tagline"><i>—</i> {{ S::get('brand_tagline') }} <i>—</i></span>
            </span>
        </a>

        <button class="nav-toggle" type="button" aria-label="Menu" aria-expanded="false" aria-controls="site-nav">
            <span></span><span></span><span></span>
        </button>

        <nav class="site-nav" id="site-nav" aria-label="Primary">
            @foreach($headerMenu as $item)
                <a href="{{ $item->url }}" class="{{ $item->is_button ? 'btn btn-nav' : 'nav-link' }}">{{ $item->label }}</a>
            @endforeach
        </nav>
    </div>
</header>

    @yield('content')

<footer class="site-footer">
    <div class="footer-inner">
        <p>{{ S::get('footer_text') }}</p>
        <nav class="footer-nav" aria-label="Footer">
            @foreach($footerMenu as $item)
                <a href="{{ $item->url }}">{{ $item->label }}</a>
            @endforeach
        </nav>
    </div>
</footer>
    <script src="{{ asset('js/site.js') }}?v={{ filemtime(public_path('js/site.js')) }}" defer></script>
</body>
</html>
