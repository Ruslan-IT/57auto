@extends('layouts.main')

@section('seo_title', 'Контакты — SQL Trainer')

@section('seo_description', 'Связаться с разработчиком SQL Trainer. Поддержка пользователей и вопросы по курсу.')

@section('seo_keywords', 'контакты, поддержка sql trainer')

@section('content')

    @php
        $settings = $settings ?? null;
    @endphp

    <div class="legal-container">

        <header style="padding: 10px;" class="legal-header">
            <h1>Контакты</h1>
            <p>Связь с автором проекта SQL Trainer</p>
        </header>

        <section class="legal-section">
            <h2>Общая информация</h2>

            <p>
                ФИО: {{ $settings->owner_name ?? 'Фазлиев Руслан Салаватович' }}
            </p>

            <p>
                Email: {{ $settings->email ?? 'Не указано' }}
            </p>

            <p>
                Telegram: {{ $settings->telegram ?? 'Не указано' }}
            </p>
        </section>

        <section class="legal-section">
            <h2>Дополнительная информация</h2>

            <p>
                По вопросам доступа к курсу, оплате и технической поддержке
                используйте указанные контакты выше.
            </p>
        </section>

    </div>

@endsection
