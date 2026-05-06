<!-- Main Header -->
<header id="header" class="main-header header header-fixed ">
    <!-- Header Lower -->
    <div class="header-lower">
        <div class="themesflat-container w1700">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-container flex justify-space align-center">
                        <!-- Logo Box -->
                        <div class="logo-box flex">
                            <div class="logo"><a href="index.html">

                                    <img src="assets/images/logo/logo2@.png" alt="Logo"></a></div>

                        </div>
                        <div class="nav-outer flex align-center">
                            <!-- Main Menu -->
                            <nav class="main-menu show navbar-expand-md">
                                <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                                    <ul class="navigation clearfix">


                                        <li><a href="/">Главная</a>
                                        <li class="dropdown2"><a href="#">Блог </a>
                                            <ul>
                                                <li><a href="/blog">Блог</a></li>
                                                <li><a href="/blog-singlel">Blog Detail</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="/about">О компании</a>


                                        <li><a href="/contacts">Контакты</a></li>
                                    </ul>
                                </div>
                            </nav>
                            <!-- Main Menu End-->
                        </div>
                        <div class="header-account flex align-center">
                            <div class="register ml--18">
                                <div class="flex align-center">
                                    @auth
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="btn-logout" style="background: none; border: none; padding: 0; color: inherit; cursor: pointer;">
                                                Выход
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('register') }}" role="button">Register</a>
                                        <a href="{{ route('login') }}" role="button">Login</a>
                                    @endauth
                                </div>
                            </div>


                            <div class="help-bar-mobie theme-toggle">
                                <button class="theme-switch" id="theme-toggle">
                                    <span class="sun-icon">
                                         <img src="{{ asset('assets/images/s.png') }}" alt="">
                                    </span>
                                    <span class="moon-icon" style="display: none;">
                                        <img src="{{ asset('assets/images/l.png') }}" alt="">
                                    </span>
                                </button>
                            </div>


                            <div class="flat-bt-top sc-btn-top ml--20 ">
                                <a class="btn-icon-list" href="car-list.html">
                                    <span>Listing Yours</span>
                                    <i class="icon-add-button-1"></i>
                                </a>
                            </div>
                        </div>

                        <div class="mobile-nav-toggler mobile-button">
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Lower -->
    <!-- Mobile Menu  -->
    <div class="close-btn"><span class="icon flaticon-cancel-1"></span></div>
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <nav class="menu-box">
            <div class="nav-logo">
                <a href="index.html"><img src="assets/images/logo/logo2@.png" alt="Логотип Motorx"></a>
            </div>
            <div class="bottom-canvas">
                <div class="menu-outer">
                    <ul class="navigation clearfix">

                        <li class="dropdown2"><a href="/">Главная</a></li>

                        <li class="dropdown2">
                            <a href="#">Блог</a>
                            <ul>
                                <li><a href="/blog">Блог</a></li>
                                <li><a href="/blog-singlel">Blog Detail</a></li>
                            </ul>
                            <div class="dropdown2-btn"></div>
                        </li>

                        <li class="dropdown2"><a href="/aboutl">О компании</a></li>
                        <li class="dropdown2"><a href="/contacts">Контакты</a></li>
                    </ul>
                </div>

            </div>
        </nav>
    </div>
    <!-- End Mobile Menu -->
</header>
<!-- End Main Header -->


@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
