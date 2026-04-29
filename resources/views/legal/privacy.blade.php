@extends('layouts.main')

@section('seo_title', 'Политика конфиденциальности — SQL Trainer')

@section('seo_description', 'Как мы обрабатываем и защищаем ваши персональные данные при использовании SQL Trainer.')

@section('seo_keywords', 'политика конфиденциальности, персональные данные, sql trainer')

@section('content')

    @php
        $settings = $settings ?? null;
    @endphp

    <div class="legal-container">

        <header style="padding: 10px;"  class="legal-header">
            <h1>Политика конфиденциальности</h1>
            <p>Обработка персональных данных пользователей</p>
        </header>

        <section class="legal-section">
            <h2>1. Общие положения</h2>
            <p>
                Настоящая политика описывает порядок обработки персональных данных
                пользователей сервиса SQL Trainer.
            </p>
        </section>

        <section class="legal-section">
            <h2>2. Сбор данных</h2>
            <p>
                Мы можем собирать следующие данные: имя, email, данные аккаунта,
                информацию о прогрессе обучения и действиях на платформе.
            </p>
        </section>

        <section class="legal-section">
            <h2>3. Использование данных</h2>
            <p>
                Данные используются исключительно для работы сервиса,
                улучшения качества обучения и персонализации опыта пользователя.
            </p>
        </section>

        <section class="legal-section">
            <h2>4. Хранение данных</h2>
            <p>
                Данные хранятся в защищённой базе данных и не передаются третьим лицам
                без законных оснований.
            </p>
        </section>

        <section class="legal-section">
            <h2>5. Контакт</h2>
            <p>
                Email: {{ $settings->email ?? 'Не указано' }}
            </p>
        </section>

    </div>

@endsection
