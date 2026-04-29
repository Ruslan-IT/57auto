@extends('layouts.main')


@section('meta')
    <meta name="robots" content="noindex, nofollow">
@endsection



@section('content')

    <div class="pricing-page">

        {{-- HEADER --}}
        <div class="pricing-header">
            <h1>Выберите доступ к курсу</h1>
            <p>Начни бесплатно или открой полный SQL курс</p>
        </div>

        {{-- PRICING CARDS --}}
        <div class="pricing-grid">

            {{-- FREE --}}
            <div class="pricing-card">
                <h2>Free</h2>

                <div class="price">
                    0₽ <span>/ всегда</span>
                </div>

                <ul>
                    <li>✔ Базовые SQL уроки</li>
                    <li>✔ Практика ограничена</li>
                    <li>✔ Проверка решений</li>
                    <li>✖ Продвинутые темы</li>
                </ul>

                <button class="btn-secondary">
                    Начать бесплатно
                </button>
            </div>

            {{-- START --}}
            <div style="display: none" class="pricing-card pricing-card--highlight">

                <div class="badge">Старт</div>

                <h2>Starter</h2>

                <div class="price">
                    99₽ <span>/ 10 дней </span>
                </div>

                <ul>
                    <li>✔ Все базовые темы</li>
                    <li>✔ Расширенная практика</li>
                    <li>✔ Сохранение прогресса</li>
                    <li>✔ Небольшие бонус задания</li>
                </ul>

                @auth
                    <form action="{{ route('payment.create') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan" value="starter">

                        <button type="submit" class="btn-primary">
                            Выбрать Starter
                        </button>
                    </form>
                @else
                    <a href="/register" class="btn-primary">
                        Зарегистрироваться
                    </a>
                @endauth

            </div>

            {{-- PRO --}}
            <div class="pricing-card">

                <h2>Pro</h2>

                <div class="price">
                    499₽ <span>/ месяц</span>
                </div>

                <ul>
                    <li>✔ Все темы курса</li>
                    <li>✔ SQL тренажёр без ограничений</li>
                    <li>✔ Рейтинг и прогресс</li>
                    <li>✔ Будущие обновления</li>
                    <li>✔ Приоритетная поддержка</li>
                </ul>

                @auth
                    <form action="{{ route('payment.create') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan" value="pro">

                        <button type="submit" class="btn-primary">
                            Открыть Pro
                        </button>
                    </form>
                @else
                    <a href="/register" class="btn-primary">
                        Зарегистрироваться
                    </a>
                @endauth

            </div>

        </div>

        {{-- FOOTNOTE --}}
        <div class="pricing-footer">
            <p>Можно начать бесплатно и перейти на Pro в любой момент</p>
        </div>

    </div>

@endsection
