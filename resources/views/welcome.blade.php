@extends('layouts.main')


@section('seo_title', '')
@section('seo_description', '')
@section('seo_keywords', '')


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







            <!-- Widget Tab best deals -->
            @include('partials.catalog-blog')
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


            @include('partials.car-slider-section', [
                'title' => 'Новые поступления',
                'buttonText' => 'Смотреть все',
                /*'link' => route('cars.index'),*/
                'cars' => $latestCars
            ])

            @include('partials.car-slider-section', [
                'title' => 'Авто с пробегом',
                'buttonText' => 'Все авто',
                /*'link' => route('cars.used'),*/
                'cars' => $usedCars
            ])

            @include('partials.car-slider-section', [
                'title' => 'Автомобили из Китая',
                'buttonText' => 'Смотреть все',
                /*'link' => route('cars.china'),*/
                'cars' => $chinaCars
            ])





            <!-- Widget our-ealers -->
            {{--<div class="widget-our-ealers">
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
            </div>--}}
            <!-- Widget our-ealers -->

            <!-- Form buy car -->
            <div class="widget-form-buy-car mg-2" id="home_page_contact">
                <div class="themesflat-container">

                    <div class="form-buy-car-wrap">

                        <div class="form-buy-car-content">

                            <div class="buy-car">
                                Скидки всем!
                            </div>

                            <div class="buy-car-ab">
                                Скидки всем!
                            </div>

                        </div>

                        <div class="form-buy-car-form">

                            <div class="title">
                                Связаться с нами
                            </div>

                            <p class="description">
                                Заполните форму и мы ответим вам в ближайшее время.
                            </p>

                            <form action="{{ route('form.submit') }}"
                                  method="POST"
                                  class="form-buy-car">

                                @csrf

                                <input type="hidden"
                                       name="type"
                                       value="home_page_contact">

                                <input type="text"
                                       style="padding: 15px 10px!important;"
                                       name="name"
                                       class="input-buy-car"
                                       placeholder="Ваше имя">

                                <input type="tel"
                                       style="padding: 15px 10px!important;"
                                       name="phone"
                                       class="input-buy-car"
                                       placeholder="Телефон">

                                <textarea name="message"
                                          style="padding: 15px 10px!important;"
                                          class="input-buy-car"
                                          placeholder="Напишите сообщение..."></textarea>

                                <button type="submit">
                                    Отправить заявку
                                </button>

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
