<div class="widget-explore-car">
    <div class="themesflat-container">
        <div class="search-form-widget">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach($categories as $cat)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $activeCategory->id == $cat->id ? 'active' : '' }}"
                                data-bs-toggle="tab"
                                data-bs-target="#tab-{{ $cat->id }}"
                                type="button"
                                role="tab"
                                data-category-id="{{ $cat->id }}">
                            {{ $cat->name }}
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>




            <div class="tab-content" id="myTabContent">
                @foreach($categories as $cat)
                    <div class="tab-pane fade {{ $activeCategory->id == $cat->id ? 'show active' : '' }}"
                         id="tab-{{ $cat->id }}"
                         role="tabpanel"
                         data-category-id="{{ $cat->id }}">
                        <!-- Форма фильтра внутри таба будет уникальной, но мы сделаем единую форму с динамическим категорией -->
                    </div>
                @endforeach
            </div>

            <!-- Единая форма фильтра (скрытая категория будет меняться при смене таба) -->
            <form id="filter-form" class="mt-4">
                <div class="inner-group grid d-flex gap-3  align-items-end">
                    <div class="form-group" style="min-width: 150px;">
                        <label>Марка</label>
                        <select name="brand_id" id="brand-select" class="form-select">
                            <option value="">Все марки</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="min-width: 150px;">
                        <label>Модель</label>
                        <select name="model_id" id="model-select" class="form-select" disabled>
                            <option value="">Сначала выберите марку</option>
                        </select>
                    </div>
                    <div class="form-group" style="min-width: 200px;">
                        <label>Цена (₽)</label>
                        <div id="price-slider" style="margin-top: 10px;"></div>
                        <div class="d-flex justify-content-between mt-2">
                            <input type="hidden" name="price_min" id="price_min" value="0">
                            <input type="hidden" name="price_max" id="price_max" value="10000000">
                            <span>от <span id="price-min-display">0</span> ₽</span>
                            <span>до <span id="price-max-display">10 000 000</span> ₽</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger button-search-listing">
                            <i class="icon-search-1"></i> Поиск
                        </button>
                    </div>
                </div>
            </form>

    </div>
</div>

<!-- Блок вывода автомобилей (изначально заполняется через Blade) -->
<div class="widget-best-deals">
    <div class="themesflat-container">
        <div class="car-list-item" id="cars-container">
            @include('partials.car_cards', ['cars' => $cars])
        </div>
        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <div class="btn-main">
                    <a href="#" class="button_main_inner load-more">Загрузить ещё</a>
                </div>
            </div>
        </div>
    </div>
</div>
