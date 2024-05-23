<section class="slider home2 home5 landing">
    <div class="slider-item">
        <div class="relative">
            <div class="row">
                <div class="col-md-7">
                    <div class="content po-content-two">
                        <div class="heading center custom_heading">
                            <h1 class="text-color-1 wow slideInDown js-letters custom_h1" data-wow-delay="50ms"
                                data-wow-duration="1000ms">@lang('lang.landing_page_statement')</h1>
                            {{-- <h1 class="text-color-1 wow slideInDown js-letters custom_h1" data-wow-delay="50ms"
                                data-wow-duration="1000ms">Find and swap your </h1>
                            <h1 class="text-color-1 wow slideInDown js-letters custom_h1" data-wow-delay="50ms"
                                data-wow-duration="1000ms"> home with others in</h1>
                            <h1 class="text-color-1 wow slideInDown js-letters custom_h1" data-wow-delay="50ms"
                                data-wow-duration="1000ms"> the Netherlands </h1>
                            <h1 class="text-color-1 wow slideInDown js-letters custom_h1" data-wow-delay="50ms"
                                data-wow-duration="1000ms"> effortlessly.</h1> --}}
                            {{-- <p class="fs-16 lh-24 fw-6 text-color-1">Find and swap your home with others in the
                                Netherlands effortlessly.</p> --}}
                        </div>

                        @if (!Session::get('token'))
                            <div class="row justify-content-center">
                                <div class="col-4 d-flex justify-content-center">
                                    <div class=" btn-signup-container">
                                        <a class="sc-button d-flex justify-content-center btn-signup"
                                            href="{{ route('register') }}">

                                            <h4>@lang('lang.sign up')</h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
