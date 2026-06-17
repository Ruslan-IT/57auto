@extends('layouts.main')


@section('seo_title', '')
@section('seo_description', '')
@section('seo_keywords', '')


@section('content')



<div class="container py-5">

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-12">

                <div class="text-center mb-5">

                    <h1 class="fw-bold mb-4">
                        Калькулятор авто из
                        {{
                            match($settings->country) {
                                'korea' => 'Кореи',
                                'china' => 'Китая',
                                'uae' => 'ОАЭ',
                                default => '',
                            }
                        }}
                    </h1>

                    <div class="d-flex justify-content-center gap-3 flex-wrap">

                        <a
                            href="{{ route('calculator.index', 'korea') }}"
                            class="btn px-4 py-2 rounded-pill shadow-sm
                        {{ $settings->country == 'korea'
                            ? 'btn-danger'
                            : 'btn-outline-danger' }}"
                        >
                            🇰🇷 Корея
                        </a>

                        <a
                            href="{{ route('calculator.index', 'china') }}"
                            class="btn px-4 py-2 rounded-pill shadow-sm
                        {{ $settings->country == 'china'
                            ? 'btn-danger'
                            : 'btn-outline-danger' }}"
                        >
                            🇨🇳 Китай
                        </a>

                        <a
                            href="{{ route('calculator.index', 'uae') }}"
                            class="btn px-4 py-2 rounded-pill shadow-sm
                        {{ $settings->country == 'uae'
                            ? 'btn-danger'
                            : 'btn-outline-danger' }}"
                        >
                            🇦🇪 ОАЭ
                        </a>

                    </div>

                </div>

            </div>

            {{-- Левая колонка --}}
            <div class="col-lg-5 mb-4">

                <div class="card border-0 shadow-lg rounded-4 h-100">

                    <div class="card-body p-4">

                        <h3 class="mb-4 fw-bold">
                            Введите данные
                        </h3>

                        <form id="calculator-form">

                            <input
                                type="hidden"
                                name="country"
                                value="{{ $settings->country }}"
                            >

                            <div class="mb-12">

                                <label class="form-label fw-semibold">
                                    Стоимость авто
                                </label>

                                <input
                                    type="number"
                                    name="price"
                                    class="form-control form-control-lg rounded-3"
                                    placeholder="Введите стоимость"
                                    required
                                >

                                <div class="mb-3">

                                    <label class="form-label fw-semibold">
                                        Год выпуска
                                    </label>

                                    <input
                                        type="number"
                                        name="year"
                                        class="form-control form-control-lg rounded-3"
                                        placeholder="2020"
                                        required
                                    >

                                </div>

                                <div class="mb-3">

                                    <label class="form-label fw-semibold">
                                        Объём двигателя (см³)
                                    </label>

                                    <input
                                        type="number"
                                        name="engine_volume"
                                        class="form-control form-control-lg rounded-3"
                                        placeholder="2000"
                                        required
                                    >

                                </div>

                                <div class="mb-3">

                                    <label class="form-label fw-semibold">
                                        Мощность (л.с.)
                                    </label>

                                    <input
                                        type="number"
                                        name="power"
                                        class="form-control form-control-lg rounded-3"
                                        placeholder="249"
                                    >

                                </div>

                                <div class="mb-4">

                                    <label class="form-label fw-semibold">
                                        Тип топлива
                                    </label>

                                    <select
                                        name="fuel_type"
                                        class="form-select form-select-lg rounded-3"
                                    >
                                        <option value="gasoline">Бензин</option>
                                        <option value="diesel">Дизель</option>
                                        <option value="hybrid">Гибрид</option>
                                        <option value="electric">Электро</option>
                                    </select>

                                </div>

                            </div>

                            <button
                                type="submit"
                                class="btn btn-danger btn-lg w-100 rounded-3 shadow-sm"
                            >
                                Рассчитать
                            </button>

                        </form>

                    </div>

                </div>

            </div>

            {{-- Правая колонка --}}
            <div class="col-lg-5">

                <div class="card border-0 shadow-lg rounded-4 h-100">

                    <div class="card-body p-4">

                        <div id="calculator-loader" style="display:none;">
                            <div class="text-center py-5">

                                <div class="spinner-border text-danger mb-3"></div>

                                <div>
                                    Выполняем расчёт...
                                </div>

                            </div>
                        </div>

                        <div id="calculator-result" style="display:none;">

                            <h3 class="mb-8 fw-bold mb-5">
                                Результат расчёта
                            </h3>


                            <div class="d-flex justify-content-between mb-5">
                                <span>Курс валют </span>
                                <strong>
                                    <span class="js-info"></span> ₽
                                </strong>
                            </div>



                            <div class="d-flex justify-content-between mb-5">
                                <span>Стоимость авто</span>
                                <strong>
                                    <span class="js-car-price"></span> ₽
                                </strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Расходы по стране</span>
                                <strong>
                                    <span class="js-country-expenses"></span> ₽
                                </strong>
                            </div>

                            <div class="country-info mb-4">
                                <small>
                                    ✓ Получение документов<br>
                                    ✓ Оформление декларации<br>
                                    ✓ Выгрузка автомобиля<br>
                                    ✓ Хранение на СВХ 5–7 дней<br>
                                    ✓ Услуги брокера<br>
                                    ✓ Получение СБКТС и ЭПТС
                                </small>
                            </div>

                            <div class="d-flex justify-content-between mb-5">
                                <span>Комиссия банка</span>
                                <strong>
                                    <span class="js-bank-fee"></span> ₽
                                </strong>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span>Таможня</span>
                                <strong>
                                    <span class="js-customs"></span> ₽
                                </strong>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between align-items-center fs-4  mt-4">

                                <span class="fw-bold">
                                    Итого
                                </span>

                                    <strong class="text-danger">
                                        <span class="js-total"></span> ₽
                                    </strong>



                            </div>

                            <p class="text-muted small mt-4">
                                * Данный расчёт носит исключительно информационный характер и не является публичной офертой.
                                Итоговая стоимость может отличаться в зависимости от актуального курса валют,
                                таможенных платежей, услуг брокеров, логистики и других факторов.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection





