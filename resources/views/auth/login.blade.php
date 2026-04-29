@extends('layouts.main')


@section('seo_title', '')
@section('seo_description', '')
@section('seo_keywords', '')


@section('content')

    <style>
        button, input[type=button], input[type=reset], input[type=submit] {
            width: 100%;
            padding: 18px;
            font-size: 16px;
            font-weight: 600;
            line-height: 21px;
            background-color: #D01818;
            color: #ffffff;
            text-transform: capitalize;
            border-radius: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        .container-auth {
            position: relative;
            margin-left: auto;
            margin-right: auto;
            padding-right: 15px;
            padding-left: 15px;
            width: 600px;
            max-width: 100%;
        }
    </style>
    <br>
    <div  class="container-auth">
        <div class="content-re-lo">

            {{-- Если нужно окно с кнопкой закрытия (например, внутри модалки) — раскомментируйте --}}
            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}

            <div class="title">Вход</div>

            <div class="register-form">
                <div class="respond-register-form">
                    <form method="POST" action="{{ route('login') }}" class="comment-form form-submit">
                        @csrf

                        <fieldset>
                            <label>Аккаунт</label>
                            <input type="email"
                                   id="email"
                                   class="tb-my-input @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="Email или имя пользователя"
                                   required
                                   autofocus>
                            @error('email')
                            <span class="error-text">{{ $message }}</span>
                            @enderror
                        </fieldset>

                        <fieldset>
                            <label>Пароль</label>
                            <input type="password"
                                   class="input-form password-input @error('password') is-invalid @enderror"
                                   name="password"
                                   placeholder="Ваш пароль"
                                   required>
                            @error('password')
                            <span class="error-text">{{ $message }}</span>
                            @enderror
                        </fieldset>

                        <div class="title-forgot t-al-right mb-20">
                            <a class="t-al-right" href="{{ route('password.request') }}">
                                Забыли пароль?
                            </a>
                        </div>

                        <button class="sc-button" type="submit">
                            <span>Войти</span>
                        </button>
                    </form>
                </div>
            </div>

            <div class="text-box text-center mt-30">
                Нет аккаунта?
                <a class="color-popup" href="{{ route('register') }}">
                    Регистрация
                </a>
            </div>
        </div>
    </div>
    <br>



@endsection


