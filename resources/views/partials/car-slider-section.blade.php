<div class="widget-new-cars">
    <div class="themesflat-container">

        <div class="new-cars-wrap">

            <div class="header-section-main mb-46">

                <h2 class="title-section-main wow fadeInUp">
                    {{ $title }}
                </h2>

                <div class="btn-read-more wow fadeInUp">
                   {{-- <a class="more-link" href="{{ $link ?? '#' }}">
                        <span>{{ $buttonText ?? 'Смотреть все' }}</span>
                        <i class="icon-arrow-up-right2"></i>
                    </a>--}}
                </div>

            </div>

            <div class="swiper new-cars mybest-selling">

                <div class="swiper-wrapper">

                    @foreach($cars as $car)

                        @include('partials.car-card', [
                            'car' => $car,
                            'swiper' => true
                        ])

                    @endforeach

                </div>

                <div class="swiper-pagination"></div>

            </div>

        </div>

    </div>
</div>
