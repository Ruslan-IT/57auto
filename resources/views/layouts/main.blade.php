<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta') {{--  ВАЖНО --}}

    <title>@yield('seo_title', 'SQL тренажер — Практика SQL онлайн')</title>

    <meta name="description" content="@yield('seo_description', '')">
    <meta name="keywords" content="@yield('seo_keywords', '')">
    <meta name="author" content="{{ config('app.name') }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph (Facebook / Telegram / LinkedIn) -->
    <meta property="og:title" content="@yield('seo_title', config('app.name'))">
    <meta property="og:description" content="@yield('seo_description', '')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('seo_image', asset('images/seo-preview.jpg'))">
    <meta property="og:site_name" content="{{ config('app.name') }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('seo_title', config('app.name'))">
    <meta name="twitter:description" content="@yield('seo_description', '')">
    <meta name="twitter:image" content="@yield('seo_image', asset('logo2.png'))">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="/assets/images/logo/favicon.png">
    <link rel="stylesheet" type="text/css" href="/assets/css/nice-select.css">
    <link rel="apple-touch-icon-precomposed" href="/assets/images/logo/logo.png">



    @livewireStyles



</head>

<body class="body counter-scroll">

<!-- preload -->
<div class="preload preload-container">
    <div class="middle">
    </div>
</div>
<!-- /preload -->



@include('partials.header')

<div class="">
    @yield('content')
</div>

@if(!request()->is('dashboard'))
    @include('partials.footer')
@endif



<script>
    (function() {
        function setTheme(theme) {
            if (theme === 'dark') {
                document.body.classList.add('dark-theme');
            } else {
                document.body.classList.remove('dark-theme');
            }
            localStorage.setItem('theme', theme);
            // Обновление иконок (если они есть)
            const toggleBtn = document.getElementById('theme-toggle');
            if (toggleBtn) {
                const sunSpan = toggleBtn.querySelector('.sun-icon');
                const moonSpan = toggleBtn.querySelector('.moon-icon');
                if (sunSpan && moonSpan) {
                    if (theme === 'dark') {
                        sunSpan.style.display = 'none';
                        moonSpan.style.display = 'inline';
                    } else {
                        sunSpan.style.display = 'inline';
                        moonSpan.style.display = 'none';
                    }
                }
            }
        }

        // Принудительно тёмная тема (сохранится в localStorage)
        function initTheme() {
            // Всегда 'dark' при первом визите
            // Но если пользователь переключил на светлую — сохранится его выбор
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'light') {
                setTheme('light');
            } else {
                setTheme('dark');   // по умолчанию тёмная
            }
        }

        function bindEvents() {
            const toggleBtn = document.getElementById('theme-toggle');
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    const isDark = document.body.classList.contains('dark-theme');
                    setTheme(isDark ? 'light' : 'dark');
                });
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                initTheme();
                bindEvents();
            });
        } else {
            initTheme();
            bindEvents();
        }
    })();
</script>

<!-- Javascript -->
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/jquery.nice-select.min.js"></script>
<script src="/assets/js/swiper-bundle.min.js"></script>
<script src="/assets/js/swiper.js"></script>
<script src="/assets/js/jquery-countTo.js"></script>
<script src="/assets/js/nouislider.min.js"></script>
<script src="/assets/js/price-ranger.js"></script>
<script src="/assets/js/magnific-popup.min.js"></script>
<script src="/assets/js/wow.min.js"></script>
<script src="/assets/js/main.js"></script>
</body>
</html>
