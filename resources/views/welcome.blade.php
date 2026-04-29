@extends('layouts.main')


@section('seo_title', 'SQL тренажёр онлайн — практика SQL, задачи и обучение с нуля - CodePractice')
@section('seo_description', 'Интерактивный SQL тренажёр для практики. Решайте задачи по SQL онлайн, изучайте запросы MySQL и прокачивайте навыки с нуля до уровня аналитика - CodePractice')
@section('seo_keywords', 'sql тренажер, sql практика, задачи по sql, обучение sql, sql онлайн, mysql запросы - CodePractice')


@section('content')


    <!-- /#page -->
    <div id="wrapper">
        <div id="page" class="clearfix">


            <!-- Slide-form -->
            <div class="tf-slide-form">
                <div class="themesflat-container">
                    <div class="slide-form t-al-center">
                        <span class="wow fadeInUp" data-wow-delay="100ms"
                              data-wow-duration="2000ms">Save up to <span class="text-red">15%</span></span>
                        <h1 class="wow fadeInUp" data-wow-delay="300ms"
                            data-wow-duration="2000ms">Автомобили <span class="text-red">с доставкой в Россию</span></h1>
                        <p class="wow fadeInUp" data-wow-delay="600ms"
                           data-wow-duration="2000ms">Китай  · Корея  </p>
                    </div>
                    <!-- Tab -->

                    <!-- Tab -->
                </div>
            </div>
            <!-- Slide-form -->

            <div class="widget-explore-car">
                <div class="themesflat-container">
                    <div class="search-form-widget">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                        aria-selected="true">Китай</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                        aria-selected="false">Корея </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#contact" type="button" role="tab" aria-controls="contact"
                                        aria-selected="false">ОАЭ</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                 aria-labelledby="home-tab">
                                <form method="post" id="search-forms">
                                    <div class="inner-group grid">
                                        <div class="form-group">
                                            <div class="group-select">
                                                <div class="nice-select" tabindex="0">
                                                    <span class="current">Make</span>
                                                    <ul class="list">
                                                        <li data-value class="option selected">Make</li>
                                                        <li data-value="Acura" class="option">Acura</li>
                                                        <li data-value="Audi" class="option">Audi</li>
                                                        <li data-value="Bentley" class="option">Bentley</li>
                                                        <li data-value="BMV" class="option">BMV</li>
                                                        <li data-value="Chevrolet" class="option">Chevrolet</li>
                                                        <li data-value="Ferrari" class="option">Ferrari</li>
                                                        <li data-value="Ford" class="option">Ford</li>
                                                        <li data-value="Lexus" class="option">Lexus</li>
                                                        <li data-value="Maybach" class="option">Maybach</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="group-select">
                                                <div class="nice-select" tabindex="0">
                                                    <span class="current">Models</span>
                                                    <ul class="list">
                                                        <li data-value class="option selected">Models</li>
                                                        <li data-value="3 Series" class="option">3 Series</li>
                                                        <li data-value="718 Boxster T" class="option">718 Boxster T</li>
                                                        <li data-value="718 Cayman" class="option">718 Cayman</li>
                                                        <li data-value="911 Carrera 4" class="option">911 Carrera 4</li>
                                                        <li data-value="A4" class="option">A4</li>
                                                        <li data-value="Bentayga" class="option">Bentayga</li>
                                                        <li data-value="Bentayga Azure" class="option">Bentayga Azure</li>
                                                        <li data-value="Bentayga Technology" class="option">Bentayga
                                                            Technology</li>
                                                        <li data-value="C Class" class="option">C Class</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="widget widget-price ">
                                                <div class="caption flex-two">
                                                    <p class="price-range">Price</p>
                                                </div>
                                                <div id="slider-range"></div>
                                                <div class="slider-labels">
                                                    <div>
                                                        <input type="hidden" name="min-value" value="">
                                                        <input type="hidden" name="max-value" value="">
                                                    </div>
                                                    <div class="number-range">
                                                        <span id="slider-range-value1"></span>
                                                        <span id="slider-range-value2"></span>
                                                    </div>
                                                </div>
                                            </div><!-- /.widget_price -->
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="button-search-listing">
                                                <i class="icon-search-1"></i>
                                                2351 Cars
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form method="post" id="search-forms2">
                                    <div class="inner-group grid">
                                        <div class="form-group">
                                            <div class="group-select">
                                                <div class="nice-select" tabindex="0">
                                                    <span class="current">Make</span>
                                                    <ul class="list">
                                                        <li data-value class="option selected">Make</li>
                                                        <li data-value="Acura" class="option">Acura</li>
                                                        <li data-value="Audi" class="option">Audi</li>
                                                        <li data-value="Bentley" class="option">Bentley</li>
                                                        <li data-value="BMV" class="option">BMV</li>
                                                        <li data-value="Chevrolet" class="option">Chevrolet</li>
                                                        <li data-value="Ferrari" class="option">Ferrari</li>
                                                        <li data-value="Ford" class="option">Ford</li>
                                                        <li data-value="Lexus" class="option">Lexus</li>
                                                        <li data-value="Maybach" class="option">Maybach</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="group-select">
                                                <div class="nice-select" tabindex="0">
                                                    <span class="current">Models</span>
                                                    <ul class="list">
                                                        <li data-value class="option selected">Models</li>
                                                        <li data-value="3 Series" class="option">3 Series</li>
                                                        <li data-value="718 Boxster T" class="option">718 Boxster T</li>
                                                        <li data-value="718 Cayman" class="option">718 Cayman</li>
                                                        <li data-value="911 Carrera 4" class="option">911 Carrera 4</li>
                                                        <li data-value="A4" class="option">A4</li>
                                                        <li data-value="Bentayga" class="option">Bentayga</li>
                                                        <li data-value="Bentayga Azure" class="option">Bentayga Azure</li>
                                                        <li data-value="Bentayga Technology" class="option">Bentayga
                                                            Technology</li>
                                                        <li data-value="C Class" class="option">C Class</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="widget widget-price ">
                                                <div class="caption flex-two">
                                                    <p class="price-range">Price</p>
                                                </div>
                                                <div id="slider-range2"></div>
                                                <div class="slider-labels">
                                                    <div>
                                                        <input type="hidden" name="min-value2" value="">
                                                        <input type="hidden" name="max-value2" value="">
                                                    </div>
                                                    <div class="number-range">
                                                        <span id="slider-range-value01"></span>
                                                        <span id="slider-range-value02"></span>
                                                    </div>
                                                </div>
                                            </div><!-- /.widget_price -->
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="button-search-listing">
                                                <i class="icon-search-1"></i>
                                                2351 Cars
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <form method="post" id="search-forms3">
                                    <div class="inner-group grid">
                                        <div class="form-group">
                                            <div class="group-select">
                                                <div class="nice-select" tabindex="0">
                                                    <span class="current">Make</span>
                                                    <ul class="list">
                                                        <li data-value class="option selected">Make</li>
                                                        <li data-value="Acura" class="option">Acura</li>
                                                        <li data-value="Audi" class="option">Audi</li>
                                                        <li data-value="Bentley" class="option">Bentley</li>
                                                        <li data-value="BMV" class="option">BMV</li>
                                                        <li data-value="Chevrolet" class="option">Chevrolet</li>
                                                        <li data-value="Ferrari" class="option">Ferrari</li>
                                                        <li data-value="Ford" class="option">Ford</li>
                                                        <li data-value="Lexus" class="option">Lexus</li>
                                                        <li data-value="Maybach" class="option">Maybach</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="group-select">
                                                <div class="nice-select" tabindex="0">
                                                    <span class="current">Models</span>
                                                    <ul class="list">
                                                        <li data-value class="option selected">Models</li>
                                                        <li data-value="3 Series" class="option">3 Series</li>
                                                        <li data-value="718 Boxster T" class="option">718 Boxster T</li>
                                                        <li data-value="718 Cayman" class="option">718 Cayman</li>
                                                        <li data-value="911 Carrera 4" class="option">911 Carrera 4</li>
                                                        <li data-value="A4" class="option">A4</li>
                                                        <li data-value="Bentayga" class="option">Bentayga</li>
                                                        <li data-value="Bentayga Azure" class="option">Bentayga Azure</li>
                                                        <li data-value="Bentayga Technology" class="option">Bentayga
                                                            Technology</li>
                                                        <li data-value="C Class" class="option">C Class</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="widget widget-price ">
                                                <div class="caption flex-two">
                                                    <p class="price-range">Price</p>
                                                </div>
                                                <div id="slider-range3"></div>
                                                <div class="slider-labels">
                                                    <div>
                                                        <input type="hidden" name="min-value3" value="">
                                                        <input type="hidden" name="max-value3" value="">
                                                    </div>
                                                    <div class="number-range">
                                                        <span id="slider-range-value03"></span>
                                                        <span id="slider-range-value04"></span>
                                                    </div>
                                                </div>
                                            </div><!-- /.widget_price -->
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="button-search-listing">
                                                <i class="icon-search-1"></i>
                                                2351 Cars
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>



            <!-- widget explore car -->
            <div class="widget-explore-car">
                <div class="themesflat-container">
                    <div class="explore-car-wrap">
                        <div class="header-section-main mb-46">
                            <h2 class="title-section-main wow fadeInUp">Explore Our cars</h2>
                            <div class="btn-read-more wow fadeInUp">
                                <a class="more-link" href="#">
                                    <span>View More</span>
                                    <i class="icon-arrow-up-right2"></i>
                                </a>
                            </div>

                        </div>
                        <div class="box-car-wrap">
                            <a href="#" class="box-car-item">
                                <div class="image-car">
                                    <img src="assets/images/partner/c12.png" alt="">
                                </div>
                                <span>Sedan</span>
                            </a>
                            <a href="#" class="box-car-item">
                                <div class="image-car">
                                    <img src="assets/images/partner/c10.png" alt="">
                                </div>
                                <span>Campers</span>
                            </a>
                            <a href="#" class="box-car-item">
                                <div class="image-car">
                                    <img src="assets/images/partner/c8.png" alt="">
                                </div>
                                <span>cabriolet</span>
                            </a>
                            <a href="#" class="box-car-item">
                                <div class="image-car">
                                    <img src="assets/images/partner/c11.png" alt="">
                                </div>
                                <span>Pickup</span>
                            </a>
                            <a href="#" class="box-car-item">
                                <div class="image-car">
                                    <img src="assets/images/partner/c7.png" alt="">
                                </div>
                                <span>Supercar</span>
                            </a>
                            <a href="#" class="box-car-item">
                                <div class="image-car">
                                    <img src="assets/images/partner/c9.png" alt="">
                                </div>
                                <span>Minivans</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- widget explore car -->

            <!-- Widget Tab best deals -->
            <div class="widget-best-deals">
                <div class="themesflat-container">
                    <div class="header-section tab-car-service">
                        <div class="heading-section">
                            <h2 class="title-section-main wow fadeInUp">Feature Listing</h2>
                        </div>
                        <ul class="nav nav-pills justify-content-end" id="pills-tab-service" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab-service" data-bs-toggle="pill"
                                        data-bs-target="#pills-home-service" type="button" role="tab"
                                        aria-selected="true"> Китай</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab-service" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile-service" type="button" role="tab"
                                        aria-selected="false">Корея</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab-service" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact-service" type="button" role="tab"
                                        aria-selected="false">ОАЭ</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home-service" role="tabpanel">
                            <!-- Widget Car Service -->



                            <div class="car-list-item">

                                <div class="tf-car-service">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-12 t-al-center">
                                    <div class="btn-main mt-45">
                                        <a href="car-list.html" class="button_main_inner">
                                            <span>More Listings</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Widget Car Service -->
                        </div>
                        <div class="tab-pane fade" id="pills-profile-service" role="tabpanel">
                            <!-- Widget Car Service -->
                            <div class="car-list-item">
                                <div class="tf-car-service">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tf-car-service">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car2.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tf-car-service">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car18.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tf-car-service">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tf-car-service">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car5.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tf-car-service">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car3.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 t-al-center">
                                    <div class="btn-main mt-45">
                                        <a href="car-list.html" class="button_main_inner">
                                            <span>More Listings</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Widget Car Service -->
                        </div>
                        <div class="tab-pane  fade" id="pills-contact-service" role="tabpanel">
                            <!-- Widget Car Service -->
                            <div class="car-list-item">
                                <div class="tf-car-service">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tf-car-service">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car2.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tf-car-service">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car18.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tf-car-service">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tf-car-service">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car5.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tf-car-service">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car3.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 t-al-center">
                                    <div class="btn-main mt-45">
                                        <a href="car-list.html" class="button_main_inner">
                                            <span>More Listings</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Widget Car Service -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widget Tab best deals -->

            <!-- Widget Video -->
            <div class="widget-tf-video">
                <div class="themesflat-container">
                    <div class="tf-video video-wrap">
                        <a href="https://www.youtube.com/watch?v=ThMXH5MrlZI" class="popup-youtube icon-video">
                            <i class="icon-Polygon-6"></i>
                        </a>
                        <div class="title-video">Watch <span class="text-red">Video</span></div>
                    </div>
                </div>
            </div>
            <!-- Widget Video -->

            <!-- Widget New cars -->
            <div class="widget-new-cars">
                <div class="themesflat-container">
                    <div class="new-cars-wrap">
                        <div class="header-section-main mb-46">
                            <h2 class="title-section-main wow fadeInUp">New cars</h2>
                            <div class="btn-read-more wow fadeInUp">
                                <a class="more-link" href="car-list.html">
                                    <span>View More</span>
                                    <i class="icon-arrow-up-right2"></i>
                                </a>
                            </div>

                        </div>
                        <div class="swiper new-cars mybest-selling">
                            <div class="swiper-wrapper">
                                <div class="tf-car-service swiper-slide">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car14.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tf-car-service swiper-slide">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car2.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tf-car-service swiper-slide">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car13.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tf-car-service swiper-slide">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car14.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tf-car-service swiper-slide">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car2.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tf-car-service swiper-slide">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car13.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widget New cars -->

            <!-- Widget New cars -->
            <div class="widget-new-cars">
                <div class="themesflat-container">
                    <div class="new-cars-wrap">
                        <div class="header-section-main mb-46">
                            <h2 class="title-section-main wow fadeInUp">Used cars</h2>
                            <div class="btn-read-more wow fadeInUp">
                                <a class="more-link" href="car-list.html">
                                    <span>View More</span>
                                    <i class="icon-arrow-up-right2"></i>
                                </a>
                            </div>

                        </div>
                        <div class="swiper new-cars mybest-selling">
                            <div class="swiper-wrapper">
                                <div class="tf-car-service swiper-slide">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car7.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tf-car-service swiper-slide">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car2.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tf-car-service swiper-slide">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car6.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tf-car-service swiper-slide">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car7.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tf-car-service swiper-slide">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car2.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tf-car-service swiper-slide">
                                    <a href="listing-details.html" class="image">
                                        <div class="stm-badge-top">
                                            <div class="feature">
                                                <span>Featured</span>
                                                <div class="cut">
                                                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.296 14.0939C13.9707 14.0939 15.3284 12.8164 15.3284 11.2406C15.3284 9.66468 13.9707 8.38718 12.296 8.38718C10.6213 8.38718 9.26367 9.66468 9.26367 11.2406C9.26367 12.8164 10.6213 14.0939 12.296 14.0939Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.45163 2.32436L7.71751 4.10772H4.71358C3.67121 4.10772 2.81836 4.91023 2.81836 5.89108V16.5913C2.81836 17.5721 3.67121 18.3746 4.71358 18.3746H19.8754C20.9177 18.3746 21.7706 17.5721 21.7706 16.5913V5.89108C21.7706 4.91023 20.9177 4.10772 19.8754 4.10772H16.8714L15.1373 2.32436H9.45163ZM12.2945 15.6996C9.67906 15.6996 7.55641 13.7022 7.55641 11.2412C7.55641 8.78013 9.67906 6.78276 12.2945 6.78276C14.9099 6.78276 17.0325 8.78013 17.0325 11.2412C17.0325 13.7022 14.9099 15.6996 12.2945 15.6996Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <p>5</p>
                                                </div>
                                            </div>
                                            <span>2023</span>

                                        </div>
                                        <div class="listing-images">
                                            <div class="hover-listing-image">
                                                <div class="wrap-hover-listing">
                                                    <div class="listing-item active" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car6.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car11.jpg"
                                                                 class="swiper-image lazy tfcl-light-gallery"
                                                                 alt="images">
                                                        </div>
                                                    </div>
                                                    <div class="listing-item view-gallery" title="Lexus LC Hybrid 2024">
                                                        <div class="images">
                                                            <img src="./assets/images/car-list/car12.jpg"
                                                                 class="swiper-image tfcl-light-gallery" alt="images">
                                                            <div class="overlay-limit">
                                                                <img src="./assets/images/car-list/img.png"
                                                                     class="icon-img" alt="icon-map">
                                                                <p>2 more photos</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bullet-hover-listing">
                                                        <div class="bl-item active"></div>
                                                        <div class="bl-item"></div>
                                                        <div class="bl-item"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="content">
                                        <span class="sub-title">Mini Cooper 3 Similar</span>
                                        <h6 class="title"><a href="listing-details.html">Chevrolet Suburban 2021 mo</a></h6>
                                        <span class="price">$27,000</span>
                                        <div class="description">
                                            <ul>
                                                <li class="listing-information fuel">
                                                    <i class="icon-gasoline-pump-1"></i>
                                                    <div class="inner">
                                                        <span>Fuel type</span>
                                                        <p>Petrol</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information size-engine">
                                                    <i class="icon-Group1"></i>
                                                    <div class="inner">
                                                        <span>Mileage</span>
                                                        <p>90 k.m</p>
                                                    </div>
                                                </li>
                                                <li class="listing-information transmission">
                                                    <i class="icon-gearbox-1"></i>
                                                    <div class="inner">
                                                        <span>Transmission</span>
                                                        <p>Auto</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="bottom-btn-wrap">
                                            <div class="btn-read-more">
                                                <a class="more-link" href="listing-details.html">
                                                    <span>View details</span>
                                                    <i class="icon-arrow-right2"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group">
                                                <a href="#" class="icon-service">
                                                    <i class="icon-heart-1-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Widget our-ealers -->
            <div class="widget-our-ealers">
                <div class="themesflat-container">
                    <div class="our-ealers">
                        <div class="header-section-main mb-46">
                            <h2 class="title-section-main wow fadeInUp">Our Dealers</h2>
                            <div class="btn-read-more wow fadeInUp">
                                <a class="more-link" href="#">
                                    <span>More Members</span>
                                    <i class="icon-arrow-up-right2"></i>
                                </a>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xxl-3">
                                <div class="tf-widget-team t-al-center">
                                    <div class="team-image">
                                        <img src="assets/images/avatar/team1.jpg" alt="Image">
                                        <a href="#" class="btn-team">
                                            <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3 25.48L25.0125 3.4675M3 2H26.48V25.48" stroke="#DF2818" stroke-width="3.5" stroke-linecap="square" stroke-linejoin="round"></path>
                                            </svg>

                                        </a>
                                    </div>
                                    <h5><a href="#">Cameron Williamson</a></h5>
                                    <span>Digital Marketer</span>
                                    <ul class="social-team">
                                        <li><a href="#"><i class="icon-6"></i></a></li>
                                        <li><a href="#"><i class="icon-4"></i></a></li>
                                        <li><a href="#"><i class="icon-8"></i></a></li>
                                        <li><a href="#"><i class="icon-11"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xxl-3">
                                <div class="tf-widget-team t-al-center">
                                    <div class="team-image">
                                        <img src="assets/images/avatar/team2.jpg" alt="Image">
                                        <a href="#" class="btn-team">
                                            <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3 25.48L25.0125 3.4675M3 2H26.48V25.48" stroke="#DF2818" stroke-width="3.5" stroke-linecap="square" stroke-linejoin="round"></path>
                                            </svg>

                                        </a>
                                    </div>
                                    <h5><a href="#">Cameron Williamson</a></h5>
                                    <span>Digital Marketer</span>
                                    <ul class="social-team">
                                        <li><a href="#"><i class="icon-6"></i></a></li>
                                        <li><a href="#"><i class="icon-4"></i></a></li>
                                        <li><a href="#"><i class="icon-8"></i></a></li>
                                        <li><a href="#"><i class="icon-11"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xxl-3">
                                <div class="tf-widget-team t-al-center">
                                    <div class="team-image">
                                        <img src="assets/images/avatar/team3.jpg" alt="Image">
                                        <a href="#" class="btn-team">
                                            <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3 25.48L25.0125 3.4675M3 2H26.48V25.48" stroke="#DF2818" stroke-width="3.5" stroke-linecap="square" stroke-linejoin="round"></path>
                                            </svg>

                                        </a>
                                    </div>
                                    <h5><a href="#">Cameron Williamson</a></h5>
                                    <span>Digital Marketer</span>
                                    <ul class="social-team">
                                        <li><a href="#"><i class="icon-6"></i></a></li>
                                        <li><a href="#"><i class="icon-4"></i></a></li>
                                        <li><a href="#"><i class="icon-8"></i></a></li>
                                        <li><a href="#"><i class="icon-11"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xxl-3">
                                <div class="tf-widget-team t-al-center">
                                    <div class="team-image">
                                        <img src="assets/images/avatar/team4.jpg" alt="Image">
                                        <a href="#" class="btn-team">
                                            <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3 25.48L25.0125 3.4675M3 2H26.48V25.48" stroke="#DF2818" stroke-width="3.5" stroke-linecap="square" stroke-linejoin="round"></path>
                                            </svg>

                                        </a>
                                    </div>
                                    <h5><a href="#">Cameron Williamson</a></h5>
                                    <span>Digital Marketer</span>
                                    <ul class="social-team">
                                        <li><a href="#"><i class="icon-6"></i></a></li>
                                        <li><a href="#"><i class="icon-4"></i></a></li>
                                        <li><a href="#"><i class="icon-8"></i></a></li>
                                        <li><a href="#"><i class="icon-11"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widget our-ealers -->

            <!-- Form buy car -->
            <div class="widget-form-buy-car mg-2">
                <div class="themesflat-container">
                    <div class="form-buy-car-wrap">
                        <div class="form-buy-car-content">
                            <div class="buy-car">Buy a car today</div>
                            <div class="buy-car-ab">Buy a car today</div>
                        </div>
                        <div class="form-buy-car-form">
                            <div class="title">Contact us Today</div>
                            <p class="description">Your email address will not be published.</p>
                            <form action="/" class="form-buy-car">
                                <input type="text" class="input-buy-car" placeholder="Full Name here" >
                                <input type="email" class="input-buy-car" placeholder="Email Address" >
                                <textarea class="input-buy-car" placeholder="Write Message....."></textarea>
                                <button type="submit"> Send message</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Form buy car -->

        </div>



    </div>
    <!-- /#page -->

    <!-- Button Top -->
    <a id="scroll-top" class="button-go"></a>
    <!-- Button Top -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true"
         tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="content-re-lo">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="title">Register</div>
                    <div class="register-form">
                        <div class="respond-register-form">
                            <form method="post" class="comment-form form-submit" action="/" accept-charset="utf-8"
                                  novalidate="novalidate">
                                <fieldset>
                                    <label>User name</label>
                                    <input type="text" class="tb-my-input" name="text" placeholder="User name">
                                </fieldset>
                                <fieldset>
                                    <label>Email</label>
                                    <input type="email" class="tb-my-input" name="email" placeholder="Email">
                                </fieldset>
                                <fieldset>
                                    <label>Password</label>
                                    <input type="password" class="input-form password-input"
                                           placeholder="Your password">
                                </fieldset>
                                <fieldset>
                                    <label>Confirm password</label>
                                    <input type="password" class="input-form password-input"
                                           placeholder="Confirm password">
                                </fieldset>
                                <button class="sc-button" name="submit" type="submit">
                                    <span>Sign Up</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="text-box text-center mt-30">Allready have an account? <a class="color-popup "
                                                                                         data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
                                                                                         data-bs-dismiss="modal">Login</a></div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true"
         tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="content-re-lo">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="title">Login</div>
                    <div class="register-form">
                        <div class="respond-register-form">
                            <form method="post" class="comment-form form-submit" action="#" accept-charset="utf-8">
                                <fieldset>
                                    <label>Account</label>
                                    <input type="email" id="email" class="tb-my-input" name="email"
                                           placeholder="Email or user name">
                                </fieldset>
                                <fieldset>
                                    <label>Password</label>
                                    <input type="password" class="input-form password-input"
                                           placeholder="Your password">
                                </fieldset>
                                <div class="title-forgot t-al-right mb-20"><a class="t-al-right"
                                                                              data-bs-target="#exampleModalToggle3" data-bs-toggle="modal"
                                                                              data-bs-dismiss="modal">Forgot password</a>
                                </div>
                                <button class="sc-button" name="submit" type="submit">
                                    <span>Login</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="text-box text-center mt-30">Don’t you have an account? <a class="color-popup"
                                                                                          data-bs-target="#exampleModalToggle" data-bs-toggle="modal"
                                                                                          data-bs-dismiss="modal">Register</a></div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalToggle3" aria-hidden="true"
         tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="content-re-lo">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="title">Forgot your password?</div>
                    <div class="register-form">
                        <div class="respond-register-form">
                            <form method="post" class="comment-form form-submit" action="#" accept-charset="utf-8">

                                <fieldset>
                                    <label>Password</label>
                                    <input type="password" class="input-form password-input"
                                           placeholder="Your password">
                                </fieldset>
                                <button class="sc-button" name="submit" type="submit">
                                    <span>Get new password</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="text-box text-center mt-30"><a class="color-popup" data-bs-target="#exampleModalToggle2"
                                                               data-bs-toggle="modal" data-bs-dismiss="modal">Back to Login</a></div>
                </div>

            </div>
        </div>
    </div><!-- Modal -->

@endsection
