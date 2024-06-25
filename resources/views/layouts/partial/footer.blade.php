<div class="widget-logo-footer" style="background: #ddd">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="wrap-logo flex align-center justify-space">
                    <div class="logo-footer style box-1" id="logo-footer">
                        <a href="{{ route('landing_page') }}">
                            <img src="{{ asset('assets/images/logo/logo.png') }}?v={{ filemtime(public_path('assets/images/logo/logo.png')) }}"
                                alt="img" width="197" height="48">
                        </a>
                    </div>
                    <div class="box-menu box-2">
                        <ul class="menu-bottom flex align-center fs-16 fw-6">

                            <li><a href="{{ route('home') }}">@lang('lang.home')</a></li>
                            <li><a href="{{ route('chats') }}">@lang('lang.messages')</a></li>
                            <li><a href="{{ route('profile.get') }}">@lang('lang.profile')</a></li>
                            <li><a href="{{ route('feed_back') }}">@lang('lang.feed back')</a></li>
                        </ul>
                    </div>

                    <span>
                        <a style="color: #2a81b2" href="{{ route('privacy-policy') }}"
                            target="_blank">@lang('lang.privacy_policy')</a>
                        {{-- <a style="color: #2a81b2" href="" target="_blank">@lang('lang.terms_of_use')</a> --}}
                    </span>

                    {{-- <div class="icon-social box-3 text-color-1">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div> --}}

                </div>

            </div>
        </div>
    </div>
</div>
