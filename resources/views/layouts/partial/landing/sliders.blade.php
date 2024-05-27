<section class="slider home2 home5 landing">
    <div class="slider-item">
        <div class="relative">
            <div class="row">
                <div class="col-md-7">
                    <div class="content po-content-two">
                        <div class="heading center custom_heading">
                            <h1 style=" white-space: normal; word-wrap: break-word;  word-break: keep-all;"
                                class="text-color-1   custom_h1">
                                @lang('lang.landing_page_statement')</h1>
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
