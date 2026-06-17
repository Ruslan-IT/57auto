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
    <link rel="icon" href="{{ asset('favicon1.png') }}" type="image/png">

    <link rel="stylesheet" type="text/css" href="/assets/css/style-2.css">

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

@include('modal.index')


<script>
    setTimeout(() => {
        const el = document.getElementById('flash-message');
        if (el) {
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 300);
        }
    }, 3000);
</script>



<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let currentCategoryId = $('.tab-pane.active').data('category-id') || {{ $activeCategory->id ?? 0 }};

        // Инициализация слайдера цен
        let slider = document.getElementById('price-slider');
        let priceMin = 0;
        let priceMax = 10000000;
        noUiSlider.create(slider, {
            start: [priceMin, priceMax],
            connect: true,
            range: { 'min': priceMin, 'max': priceMax },
            step: 10000
        });
        slider.noUiSlider.on('update', function(values) {
            $('#price_min').val(Math.round(values[0]));
            $('#price_max').val(Math.round(values[1]));
            $('#price-min-display').text(Math.round(values[0]).toLocaleString());
            $('#price-max-display').text(Math.round(values[1]).toLocaleString());
        });

        // Подгрузка моделей при выборе марки
        $('#brand-select').on('change', function() {
            let brandId = $(this).val();
            let modelSelect = $('#model-select');
            modelSelect.prop('disabled', true).html('<option value="">Загрузка...</option>');

            if (brandId) {
                $.get('/api/models/' + brandId, function(models) {
                    let options = '<option value="">Все модели</option>';
                    $.each(models, function(key, model) {
                        options += `<option value="${model.id}">${model.name}</option>`;
                    });
                    modelSelect.html(options).prop('disabled', false);

                }).fail(function() {
                    modelSelect.html('<option value="">Ошибка загрузки</option>');
                });
            }

            else {
                modelSelect.html('<option value="">Сначала выберите марку</option>').prop('disabled', true);
            }
        });

        // Смена таба – обновляем фильтр и перезагружаем машины
        $('#myTab button').on('shown.bs.tab', function(e) {
            currentCategoryId = $(e.target).data('category-id');
            applyFilter();
        });

        // Отправка фильтра
        $('#filter-form').on('submit', function(e) {
            e.preventDefault();


            applyFilter();


        });

        function applyFilter() {

            let formData = {
                category_id: currentCategoryId,
                brand_id: $('#brand-select').val(),
                model_id: $('#model-select').val(),
                price_min: Number($('#price_min').val()) || 0,
                price_max: Number($('#price_max').val()) || 10000000,
            };

            let button = document.querySelector('.button-search-listing');

            // loader START
            button.textContent = 'Загружаю...';
            button.disabled = true;

            $.ajax({
                url: '/filter',
                method: 'POST',
                data: formData,

                success: function(response) {
                    $('#cars-container').html(response.html);
                    initCarGalleries();
                },

                error: function() {
                    alert('Ошибка загрузки автомобилей');
                },

                complete: function() {
                    // loader END (ВАЖНО — всегда срабатывает)
                    button.textContent = 'Поиск';
                    button.disabled = false;
                }
            });
        }

        // Загрузка ещё (пагинация) – можно реализовать позже, но для простоты пока не делаем
    });




</script>

<script>
    // Функция для инициализации галерей внутри каждой карточки
    function initCarGalleries() {
        document.querySelectorAll('.wrap-hover-listing').forEach(wrap => {
            const items = wrap.querySelectorAll('.listing-item');
            const bullets = wrap.querySelectorAll('.bl-item');

            if (items.length === 0) return;

            // Функция активации элемента по индексу
            const setActive = (index) => {
                items.forEach((item, i) => {
                    if (i === index) {
                        item.classList.add('active');
                    } else {
                        item.classList.remove('active');
                    }
                });
                bullets.forEach((bullet, i) => {
                    if (i === index) {
                        bullet.classList.add('active');
                    } else {
                        bullet.classList.remove('active');
                    }
                });
            };

            // Навешиваем события на каждый превью (listing-item)
            items.forEach((item, idx) => {
                item.addEventListener('mouseenter', () => setActive(idx));
            });

            // Навешиваем события на буллеты
            bullets.forEach((bullet, idx) => {
                bullet.addEventListener('mouseenter', () => setActive(idx));
            });
        });
    }

    // Вызываем после загрузки страницы и после каждого AJAX-обновления (если фильтр через AJAX)
    document.addEventListener('DOMContentLoaded', initCarGalleries);

    // Если вы используете AJAX-фильтрацию и обновляете контейнер с машинами,
    // то после подстановки новых карточек нужно вызывать initCarGalleries() снова.
    // Например, в успешном ответе фильтра:
    // $('#cars-container').html(response.html);
    // initCarGalleries();
</script>



<script>



    $('#calculator-form').on('submit', function(e){


        e.preventDefault();

        $('#calculator-loader').show();

        $.ajax({

            url: '{{ route('calculator.calculate') }}',

            type: 'POST',

            data: $(this).serialize(),

            success: function(response){

                $('#calculator-loader').hide();

                if(response.success){

                    $('#calculator-result').show();

                    $('.js-info').text(
                        Number(response.data.currency_rate).toLocaleString('ru-RU')
                    );

                    $('.js-car-price').text(
                        Number(response.data.car_price_rub).toLocaleString('ru-RU')
                    );

                    $('.js-country-expenses').text(
                        Number(response.data.country_expenses).toLocaleString('ru-RU')
                    );

                    $('.js-bank-fee').text(
                        Number(response.data.bank_fee).toLocaleString('ru-RU')
                    );

                    $('.js-customs').text(
                        Number(response.data.customs).toLocaleString('ru-RU')
                    );

                    $('.js-total').text(
                        Number(response.data.total).toLocaleString('ru-RU')
                    );

                }

            },

            error: function(xhr){

                $('#calculator-loader').hide();

                console.log(xhr.responseJSON);

                alert('Ошибка расчёта');

            }

        });

    });

</script>

</body>
</html>
