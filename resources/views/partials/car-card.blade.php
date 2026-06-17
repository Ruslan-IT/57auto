<div class="tf-car-service {{ $swiper ?? false ? 'swiper-slide' : '' }}">
    <a href="{{ route('car.show', $car->id) }}" class="image">
        <div class="stm-badge-top">
            @if($car->is_min_util)
                <div class="feature">
                    <span>Льготный утильсбор</span>
                </div>
            @endif

            <span>{{ $car->year }}</span>
        </div>

        <div class="listing-images">
            <div class="hover-listing-image">
                <div class="wrap-hover-listing">

                    @php $images = $car->images->take(3); @endphp

                    @foreach($images as $index => $img)
                        <div class="listing-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="images">
                                <img src="{{ asset('storage/' . $img->path) }}"
                                     class="swiper-image"
                                     alt="{{ $car->title }}">
                            </div>
                        </div>
                    @endforeach

                    @if($car->images->count() > 3)
                        <div class="listing-item view-gallery">
                            <div class="images">
                                <img src="{{ asset('storage/' . $car->images->first()->path) }}"
                                     alt="more">

                                <div class="overlay-limit">
                                    <p>+{{ $car->images->count() - 3 }} фото</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="bullet-hover-listing">
                        @foreach($images as $idx => $img)
                            <div class="bl-item {{ $idx == 0 ? 'active' : '' }}"></div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </a>

    <div class="content">

        <span class="sub-title">
            {{ $car->brand->name }} {{ $car->model->name }}
        </span>

        <h6 class="title">
            <a href="{{ route('car.show', $car->id) }}">
                {{ $car->title ?? $car->brand->name . ' ' . $car->model->name . ' ' . $car->year }}
            </a>
        </h6>

        <span class="price">
            {{ number_format($car->price_russia, 0, ',', ' ') }} ₽
        </span>

        <div class="description">
            <ul>

                <li class="listing-information fuel">
                    <i class="icon-gasoline-pump-1"></i>

                    <div class="inner">
                        <span>Топливо</span>
                        <p>{{ $car->engine_type_label ?? 'Бензин' }}</p>
                    </div>
                </li>

                <li class="listing-information size-engine">
                    <i class="icon-Group1"></i>

                    <div class="inner">
                        <span>Пробег</span>
                        <p>{{ number_format($car->mileage, 0, ',', ' ') }} км</p>
                    </div>
                </li>

                <li class="listing-information transmission">
                    <i class="icon-gearbox-1"></i>

                    <div class="inner">
                        <span>КПП</span>
                        <p>{{ $car->transmission_label ?? 'Автомат' }}</p>
                    </div>
                </li>

            </ul>
        </div>

        <div class="bottom-btn-wrap">

            <div class="btn-read-more">
                <a class="more-link" href="{{ route('car.show', $car->id) }}">
                    <span>Подробнее</span>
                    <i class="icon-arrow-right2"></i>
                </a>
            </div>

            <div class="btn-group">

            </div>

        </div>

    </div>
</div>
