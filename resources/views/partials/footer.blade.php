
<footer id="footer" class="clearfix bg-footer2 pd-t81 re-hi">

    <div class="themesflat-container">

        <div class="row footer-top">

            <div class="col-lg-6 col-md-12 col-12 pd-r80">

                <h2 class="title-footer-top">
                    Подобрать <span class="red-title">автомобиль</span> под ваш бюджет?
                </h2>



            </div>

            <div class="col-lg-6 col-md-12 col-12 t-al-right pt-20">

                <a href="#home_page_contact" class="btn-sell">
                    Оставить заявку
                </a>

            </div>

        </div>

        <div class="row footer-main">

            <!-- О компании -->
            <div class="col-lg-3 col-md-6 col-12">

                <div class="widget widget-info">

                    <img src="{{ asset('assets/images/logo/logo2@.png') }}"
                         alt="Logo Footer">

                    <p>
                        Помогаем подобрать и привезти автомобили из Китая,
                        Кореи и ОАЭ под заказ.
                    </p>

                    <ul>

                        <li>
                            <i class="icon-Vector1"></i>

                            <p>
                                Москва, Россия
                            </p>
                        </li>

                        <li>
                            <i class="icon-Group-1"></i>

                            <p>
                                {{ $settings->email }}
                            </p>
                        </li>

                    </ul>

                </div>

            </div>

            <!-- Меню -->
            <div class="col-lg-3 col-md-6 col-12">

                <div class="widget widget-menu pl-60">

                   {{-- <h3>Каталог</h3>

                    <ul class="box-menu">
                        <li><a href="#">Авто из Китая</a></li>
                        <li><a href="#">Авто из Кореи</a></li>
                        <li><a href="#">Авто из ОАЭ</a></li>
                        <li><a href="#">Новые поступления</a></li>
                        <li><a href="#">Авто с пробегом</a></li>
                    </ul>--}}

                </div>

            </div>

            <!-- Информация -->
            <div class="col-lg-3 col-md-6 col-12">

                <div class="widget widget-menu pl-30">

                    <h3>Информация</h3>

                    <ul class="box-menu">
                        <li><a href="#">О компании</a></li>
                        <li><a href="#">Доставка</a></li>
                        <li><a href="#">Растаможка</a></li>
                        <li><a href="#">Контакты</a></li>
                        <li><a href="#">Политика конфиденциальности</a></li>
                    </ul>

                </div>

            </div>

            <!-- Форма -->
            <div class="col-lg-3 col-md-6 col-12">

                <div class="widget widget-menu widget-form">

                    <h3>Получить консультацию</h3>

                    <form method="POST"
                          action="{{ route('form.submit') }}"
                          class="email-footer-form">

                        @csrf

                        <input type="hidden"
                               name="type"
                               value="footer_consultation">

                        <div class="text-wrap clearfix">

                            <fieldset class="email-wrap style-text">

                                <input type="text"
                                       class="tb-my-input"
                                       name="name"
                                       placeholder="Ваше имя"
                                       required>

                            </fieldset>

                            <fieldset class="email-wrap style-text mt-3">

                                <input type="tel"
                                       class="tb-my-input"
                                       name="phone"
                                       placeholder="Телефон"
                                       required>

                            </fieldset>

                            <fieldset class="email-wrap style-text mt-3">

                                <textarea name="message"
                                          class="tb-my-input"
                                          placeholder="Ваш вопрос"></textarea>

                            </fieldset>

                            <fieldset class="email-wrap style-text mt-3">

                                <button type="submit" class=" tb-my-input">

                                    Отправить

                                </button>

                            </fieldset>






                        </div>

                    </form>

                </div>

            </div>

        </div>

        <div class="row footer-bottom">

            <div class="col-12 col-md-6 col-lg-6 col-xl-4">

                <p class="coppy-right">
                    © {{ date('Y') }} Все права защищены
                </p>

            </div>

            <div class="col-12 col-md-6 col-lg-6 col-xl-4">

                <ul class="social-icon">

                  {{--  <li>
                        <a href="#"><i class="icon-6"></i></a>
                    </li>

                    <li>
                        <a href="#"><i class="icon-4"></i></a>
                    </li>

                    <li>
                        <a href="#"><i class="icon-5"></i></a>
                    </li>--}}

                </ul>

            </div>

            <div class="col-md-12 col-lg-12 col-xl-4">

                <ul class="bottom-bar-menu">

                    <li>
                        <a href="#">Политика конфиденциальности</a>
                    </li>

                    <li>
                        <a href="#">Пользовательское соглашение</a>
                    </li>

                </ul>

            </div>

        </div>

    </div>

    <img src="assets/images/page/ft-left.png"
         alt="left"
         class="shape-left">

    <img src="assets/images/page/ft-right.png"
         alt="right"
         class="shape-right">

</footer>


