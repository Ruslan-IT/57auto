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

    <div  class="container-auth">
        <br>
        <div class="content-re-lo">
            @if(isset($modal))
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            @endif
            <div class="title">Регистрация</div>
            <div class="register-form">
                <div class="respond-register-form">
                    <form method="POST" action="{{ route('register') }}" class="comment-form form-submit">
                        @csrf

                        <fieldset>
                            <label>Имя пользователя</label>
                            <input type="text" class="tb-my-input @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" placeholder="Имя пользователя" required autofocus>
                            @error('name')
                            <span class="error-text">{{ $message }}</span>
                            @enderror
                        </fieldset>

                        <fieldset>
                            <label>Email</label>
                            <input type="email" class="tb-my-input @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" placeholder="Email" required>
                            @error('email')
                            <span class="error-text">{{ $message }}</span>
                            @enderror
                        </fieldset>

                        <fieldset>
                            <label>Пароль</label>
                            <input type="password" class="input-form password-input @error('password') is-invalid @enderror"
                                   name="password" placeholder="Ваш пароль" required>
                            @error('password')
                            <span class="error-text">{{ $message }}</span>
                            @enderror
                        </fieldset>

                        <fieldset>
                            <label>Подтверждение пароля</label>
                            <input type="password" class="input-form password-input"
                                   name="password_confirmation" placeholder="Повторите пароль" required>
                        </fieldset>

                        <button class="sc-button" type="submit">
                            <span>Зарегистрироваться</span>
                        </button>
                    </form>
                </div>
            </div>
            <div class="text-box text-center mt-30">
                Уже есть аккаунт?
                <a class="color-popup" href="{{ route('login') }}">
                    Войти
                </a>
            </div>
        </div>
    </div>
    <br>



@endsection


