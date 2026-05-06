

@extends('layouts.main')


@section('seo_title', 'SQL тренажёр онлайн — практика SQL, задачи и обучение с нуля - CodePractice')
@section('seo_description', 'Интерактивный SQL тренажёр для практики. Решайте задачи по SQL онлайн, изучайте запросы MySQL и прокачивайте навыки с нуля до уровня аналитика - CodePractice')
@section('seo_keywords', 'sql тренажер, sql практика, задачи по sql, обучение sql, sql онлайн, mysql запросы - CodePractice')


@section('content')


    <!-- property-detail -->
    <div class="widget-property-detail">
        <div class="themesflat-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrap-property-car flex">
                        <div class="box-1">
                            <div class="icon-box-info flex">
                                @if($car->is_min_util)
                                    <div class="info-sale">
                                        <span class="sale">Льготный утильсбор</span>
                                    </div>
                                @endif
                                <div class="info flex">
                                    <span>Марка:</span>
                                    <span class="fw-4">{{ $car->brand->name }}</span>
                                </div>
                                <div class="info flex">
                                    <span>Модель:</span>
                                    <span class="fw-4">{{ $car->model->name }}</span>
                                </div>
                                <div class="info flex">
                                    <span>Кузов:</span>
                                    <span class="fw-4">
                                    @switch($car->body_type)
                                            @case('vnedorozhnik') Внедорожник @break
                                            @case('sedan') Седан @break
                                            @case('hetchbek') Хэтчбек @break
                                            @case('mikroavtobus') Микроавтобус @break
                                            @case('pikap') Пикап @break
                                            @default {{ $car->body_type }}
                                        @endswitch
                                </span>
                                </div>
                            </div>
                            <div class="title-heading">{{ $car->title ?? $car->brand->name . ' ' . $car->model->name . ' ' . $car->year }}</div>
                            <div class="text-address">
                                <i class="icon-map-1-1"></i>
                                <p>Лот № {{ $car->lot }}</p>
                            </div>
                        </div>
                        <div class="box-2 t-al-right">
                            <div class="icon-boxs flex">
                                <a href="#">
                                    <i class="icon-heart-1-1"></i>
                                    <span>В избранное</span>
                                </a>
                                <a href="#">
                                    <i class="icon-shuffle-2-11"></i>
                                    <span>Сравнить</span>
                                </a>
                            </div>
                            <div class="price-wrap flex">
                                @if($car->price_russia && $car->price_china)
                                    <p class="price-sale">{{ number_format($car->price_russia, 0, ',', ' ') }} ₽</p>
                                    <p class="price">{{ number_format($car->price_china * 12, 0, ',', ' ') }} ₽*</p>
                                @elseif($car->price_russia)
                                    <p class="price-sale">{{ number_format($car->price_russia, 0, ',', ' ') }} ₽</p>
                                @elseif($car->price_china)
                                    <p class="price-sale">{{ number_format($car->price_china, 0, ',', ' ') }} ¥</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ГАЛЕРЕЯ (два Swiper: основной и миниатюры) -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="gallary-property-details">
                        <div class="swiper property-gallary2">
                            <div class="swiper-wrapper">
                                @foreach($car->images as $image)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $car->title }}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                        <div class="swiper property-gallary">
                            <div class="swiper-wrapper">
                                @foreach($car->images as $image)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/' . $image->path) }}" alt="thumb">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="post-property">
                        <!-- Описание -->
                        <div class="wrap-description wrap-style">
                            <h4 class="title">Описание</h4>
                            <p>{{ $car->description ?? 'Нет описания' }}</p>
                        </div>

                        <!-- Характеристики (Car Overview) -->
                        <div class="wrap-car-overview wrap-style">
                            <h4 class="title">Основные характеристики</h4>
                            <div class="listing-info">
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 item">
                                        <div class="inner listing-infor-box">
                                            <div class="icon"><i class="icon-Vector5"></i></div>
                                            <div class="content-listing-info">
                                                <span class="listing-info-title">Год выпуска:</span>
                                                <p class="listing-info-value">{{ $car->year }}@if($car->month) / {{ $car->month }}@endif</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 item">
                                        <div class="inner listing-infor-box">
                                            <div class="icon"><i class="icon-dashboard-2"></i></div>
                                            <div class="content-listing-info">
                                                <span class="listing-info-title">Пробег:</span>
                                                <p class="listing-info-value">{{ number_format($car->mileage, 0, ',', ' ') }} км</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 item">
                                        <div class="inner listing-infor-box">
                                            <div class="icon"><i class="icon-engine-1"></i></div>
                                            <div class="content-listing-info">
                                                <span class="listing-info-title">Двигатель:</span>
                                                <p class="listing-info-value">
                                                    @switch($car->engine_type)
                                                        @case('elektromobil') Электромобиль @break
                                                        @case('benzin') Бензин @break
                                                        @case('diesel') Дизель @break
                                                        @case('gibrid') Гибрид @break
                                                        @default {{ $car->engine_type }}
                                                    @endswitch
                                                    @if($car->engine_volume) , {{ $car->engine_volume }} см³ @endif
                                                    @if($car->engine_power) , {{ $car->engine_power }} кВт @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 item">
                                        <div class="inner listing-infor-box">
                                            <div class="icon"><i class="icon-Format-color-fill"></i></div>
                                            <div class="content-listing-info">
                                                <span class="listing-info-title">Цвет:</span>
                                                <p class="listing-info-value">{{ $car->color ?? 'Не указан' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 item">
                                        <div class="inner listing-infor-box">
                                            <div class="icon"><i class="icon-Group-22"></i></div>
                                            <div class="content-listing-info">
                                                <span class="listing-info-title">Коробка передач:</span>
                                                <p class="listing-info-value">
                                                    @switch($car->transmission)
                                                        @case('automatic') Автомат @break
                                                        @case('mechanical') Механика @break
                                                        @case('variator') Вариатор @break
                                                        @case('robot') Робот @break
                                                        @default {{ $car->transmission }}
                                                    @endswitch
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 item">
                                        <div class="inner listing-infor-box">
                                            <div class="icon"><i class="icon-steering-wheel-1"></i></div>
                                            <div class="content-listing-info">
                                                <span class="listing-info-title">Привод:</span>
                                                <p class="listing-info-value">
                                                    @switch($car->drive)
                                                        @case('peredniy') Передний @break
                                                        @case('zadniy') Задний @break
                                                        @case('4wd') Полный 4WD @break
                                                        @default {{ $car->drive }}
                                                    @endswitch
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 item">
                                        <div class="inner listing-infor-box">
                                            <div class="icon"><i class="icon-Vector-13"></i></div>
                                            <div class="content-listing-info">
                                                <span class="listing-info-title">Лот:</span>
                                                <p class="listing-info-value">{{ $car->lot }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 item">
                                        <div class="inner listing-infor-box">
                                            <div class="icon"><i class="icon-Vector-13"></i></div>
                                            <div class="content-listing-info">
                                                <span class="listing-info-title">Источник:</span>
                                                <p class="listing-info-value">{{ $car->source_site ?? 'che168.com' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Дополнительные опции (если нужно выводить особенности) – можно оставить пустым или убрать -->
                        <div class="wrap-car-feature wrap-style">
                            <h4 class="title">Особенности</h4>
                            <div class="tf-listing-info">
                                <div id="tf-features">
                                    <div class="features-item">
                                        <div class="listing-feature-wrap">
                                            <i class="icon-Vector-32"></i> Льготный утильсбор: {{ $car->is_min_util ? 'Да' : 'Нет' }}
                                        </div>
                                        <div class="listing-feature-wrap">
                                            <i class="icon-Vector-32"></i> Проходной автомобиль: {{ $car->is_passable ? 'Да' : 'Нет' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Карта – можно оставить как есть или убрать, если не нужна -->
                        <div class="wrap-car-location wrap-style">
                            <h4 class="title">Расположение</h4>
                            <div class="listing-address">
                                <svg width="22" height="30" viewBox="0 0 22 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 29.1211C7.48438 23.8477 1.33203 16.6992 1.33203 10.5469C1.33203 5.21596 5.66908 0.878908 11 0.878908C16.3309 0.878908 20.668 5.21596 20.668 10.5469C20.668 16.6992 14.5156 23.8477 11 29.1211Z" stroke="#D01818" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11 14.9414C8.57697 14.9414 6.60547 12.9699 6.60547 10.5469C6.60547 8.12385 8.57697 6.15234 11 6.15234C13.423 6.15234 15.3945 8.12385 15.3945 10.5469C15.3945 12.9699 13.423 14.9414 11 14.9414Z" stroke="#D01818" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <p>Поставка из Китая, полное таможенное оформление</p>
                            </div>
                            <div class="map2">
                                <div id="map2"></div>
                            </div>
                        </div>

                        <!-- Калькулятор, отзывы и форма комментариев можно оставить как статические заглушки или убрать – по желанию -->
                    </div>
                </div>

                <!-- Боковая панель (контакты, форма) -->
                <div class="col-lg-4 col-md-12">
                    <div class="driver-price-wrap mb-40">
                        <a class="test-driver mb-16" data-bs-toggle="modal" href="#test-driver" role="button">
                            Записаться на тест-драйв
                            <i class="icon-steering-wheel-1"></i>
                        </a>
                        <a class="offer-price" data-bs-toggle="modal" href="#offer-price" role="button">
                            Предложить цену
                            <i class="icon-Group-12"></i>
                        </a>
                    </div>
                    <div class="author-contact-listing-wrap">
                        <div class="author-contact-wrap">

                            <div class="author-contact-info">
                                <h4 class="name">Автосалон</h4>
                                <p class="desc">Официальный дилер</p>
                                <span class="number-phone">
                                <i class="icon-Group-14"></i>
                                {{ $settings->phone }}
                            </span>
                            </div>
                        </div>
                        <form action="/" method="post" class="form-contact-admin">
                            <div class="group-form">
                                <input class="admin-form" placeholder="Ваше имя" type="text">
                                <i class="icon-user-1-1"></i>
                            </div>
                            <div class="group-form">
                                <input class="admin-form" placeholder="Email" type="email">
                                <i class="icon-Group2"></i>
                            </div>
                            <div class="group-form">
                                <input class="admin-form" placeholder="Телефон" type="text">
                                <i class="icon-Group-14"></i>
                            </div>
                            <div class="group-form">
                                <textarea class="admin-form" placeholder="Сообщение"></textarea>
                                <i class="icon-edit-1"></i>
                            </div>
                            <button type="submit">Отправить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
