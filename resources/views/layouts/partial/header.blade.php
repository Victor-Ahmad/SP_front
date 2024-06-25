<header id="header" class="main-header home3 header header-fixed style-absolute custom_header">
    <!-- Header Lower -->
    <div class="header-lower">
        <div class="container6">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-container flex justify-space align-center">
                        <!-- Logo Box -->
                        <div class="logo-box flex">
                            <div class="logo"><a href="{{ route('landing_page') }}">
                                    <img style="height: 40px; width: auto;"
                                        src="{{ asset('assets/images/logo/logo.png') }}?v={{ filemtime(public_path('assets/images/logo/logo.png')) }}"
                                        alt="" title="">
                                </a></div>
                        </div>
                        <div class="nav-outer flex align-center">
                            <!-- Main Menu -->
                            <nav class="main-menu show navbar-expand-md">
                                <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                                    <ul class="navigation clearfix">
                                        <li><a href="{{ route('home', 1) }}">@lang('lang.home')</a></li>
                                        <li>
                                            <a href="{{ route('chats') }}" class="position-relative">@lang('lang.messages')
                                                <span id="unread-count" class="badge" style="display: none;"></span>
                                            </a>
                                        </li>
                                        <li><a href="{{ route('profile.get') }}">@lang('lang.profile')</a></li>
                                        <li><a href="{{ route('feed_back') }}">@lang('lang.feed back')</a></li>


                                        <li class="facebook_custom"> <a
                                                href="https://www.facebook.com/profile.php?id=61560892673549"
                                                target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i>
                                                Facebook</a></li>

                                        <li> <a href="https://www.instagram.com/snelwoningruil" target="_blank"
                                                class="social-icon"><i class="fab fa-instagram"></i> Instagram</a></li>

                                    </ul>
                                </div>

                            </nav>
                            <!-- Main Menu End-->

                        </div>

                        <div class="header-account flex align-center">
                            <div class="language-switcher">
                                <div class="language-menu">
                                    <button class="menu-btn">{{ strtoupper(app()->getLocale()) }}</button>
                                    <div class="menu-content">
                                        <ul class="language-list">
                                            <li>
                                                <a href="{{ route('lang.switch', ['locale' => 'en']) }}"
                                                    class="{{ app()->getLocale() == 'en' ? 'selected' : '' }}">EN</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('lang.switch', ['locale' => 'nl']) }}"
                                                    class="{{ app()->getLocale() == 'nl' ? 'selected' : '' }}">NL</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                            <div class="register">
                                <ul class="flex align-center">
                                    <li>
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                            style="color:#2a81b2" xmlns="http://www.w3.org/2000/svg">
                                            <!-- SVG content -->
                                        </svg>
                                    </li>
                                    @if (session('token'))
                                        <li class="auth_btn"><a href="{{ route('logout') }}">@lang('lang.logout')</a>
                                        </li>
                                    @else
                                        <li class="auth_btn"><a href="{{ route('register') }}">@lang('lang.register')</a>
                                        </li>
                                        <li><span>/</span></li>
                                        <li class="auth_btn"><a href="{{ route('login') }}">@lang('lang.login')</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div class="mobile-nav-toggler mobile-button mobi-style"><span></span></div>
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
            <div class="nav-logo"><a href="index.html"><img
                        src="{{ asset('assets/images/logo/logo.png') }}?v={{ filemtime(public_path('assets/images/logo/logo.png')) }}"
                        alt="" width="197" height="48"></a></div>
            <div class="bottom-canvas">
                <div class="login-box flex align-center">
                    @if (session('token'))
                        <a href="{{ route('logout') }}" class="fw-7 font-2 text-color-2">@lang('lang.logout')</a>
                    @else
                        <a href="{{ route('register') }}" class="fw-7 font-2 text-color-2">@lang('lang.register')</a>
                        <li><span>/</span></li>
                        <a href="{{ route('login') }}" class="fw-7 font-2 text-color-2">@lang('lang.login')</a>
                    @endif
                </div>
                <div class="menu-outer"></div>
            </div>
        </nav>
    </div>
    <!-- End Mobile Menu -->
</header>
