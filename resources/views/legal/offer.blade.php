@extends('layouts.main')

@section('seo_title', 'Публичная оферта — SQL Trainer')

@section('seo_description', 'Условия использования сервиса SQL Trainer. Публичная оферта и правила предоставления доступа к курсу.')

@section('seo_keywords', 'публичная оферта, условия использования, sql trainer')

@section('content')

    @php
        $settings = $settings ?? null;
    @endphp

    <div class="legal-container">

        <header style="padding: 10px;"  class="legal-header">
            <h1>Публичная оферта</h1>
            <p>Условия предоставления доступа к онлайн-сервису SQL Trainer</p>
        </header>

        <section class="legal-section">
            <h2>1. Общие положения</h2>
            <p>
                Настоящая публичная оферта является официальным предложением
                и определяет условия использования онлайн-сервиса SQL Trainer.
            </p>
        </section>

        <section class="legal-section">
            <h2>2. Предмет договора</h2>
            <p>
                Сервис предоставляет пользователю доступ к образовательной платформе,
                включающей интерактивные задания по SQL, автоматическую проверку решений
                и систему прогресса.
            </p>
        </section>

        <section class="legal-section">
            <h2>3. Условия предоставления доступа</h2>
            <p>
                Бесплатный доступ предоставляется к базовым материалам.
                Расширенный доступ к полному курсу предоставляется после регистрации и оплаты.
            </p>
        </section>

        <section class="legal-section">
            <h2>4. Исполнитель</h2>
            <p>
                {{ $settings->owner_name ?? 'Не указано' }}
            </p>
        </section>

        <section class="legal-section">
            <h2>5. Контактная информация</h2>
            <p>
                Email: {{ $settings->email ?? 'Не указано' }}<br>
                Telegram: {{ $settings->telegram ?? 'Не указано' }}
            </p>
        </section>

    </div>

@endsection
