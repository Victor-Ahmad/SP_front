<section class="flat-featured wg-dream home5">
    <div class="container3">
        <div class="row">
            <div class="col-lg-12 background_white">
                <div class="heading-section center">
                    <h2 class="heading_title">Available Offers</h2>
                </div>
                <!-- Filter Form Start -->

                <div class="content-inner tab-content flex-center">
                    <div class="form-sl col-md-12 form-sl-spaced">
                        <form method="GET" action="{{ url('/home') }}" class="filter-form">
                            <div class="wd-find-select flex">
                                <!-- Location Dropdown -->
                                <div class="form-group form-style">
                                    <div class="group-select">
                                        <div class="nice-select" tabindex="0">
                                            <span class="current">{{ request('location', 'Location') }}</span>
                                            <ul class="list">
                                                <li data-value=""
                                                    class="option {{ request('location') == '' ? 'selected' : '' }}">
                                                    Location</li>
                                                <li data-value="bungalow"
                                                    class="option {{ request('location') == 'bungalow' ? 'selected' : '' }}">
                                                    Bungalow</li>
                                                <li data-value="apartment"
                                                    class="option {{ request('location') == 'apartment' ? 'selected' : '' }}">
                                                    Apartment</li>
                                                <li data-value="house"
                                                    class="option {{ request('location') == 'house' ? 'selected' : '' }}">
                                                    House</li>
                                                <li data-value="smart-home"
                                                    class="option {{ request('location') == 'smart-home' ? 'selected' : '' }}">
                                                    Smart Home</li>
                                                <li data-value="office"
                                                    class="option {{ request('location') == 'office' ? 'selected' : '' }}">
                                                    Office</li>
                                                <li data-value="villa"
                                                    class="option {{ request('location') == 'villa' ? 'selected' : '' }}">
                                                    Villa</li>
                                            </ul>
                                            <input type="hidden" name="location" value="{{ request('location') }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- Rooms Dropdown -->
                                <div class="form-group form-style">
                                    <div class="group-select">
                                        <div class="nice-select" tabindex="0">
                                            <span class="current">{{ request('rooms', 'Rooms: Any') }}</span>
                                            <ul class="list">
                                                <li data-value="1"
                                                    class="option {{ request('rooms') == '1' ? 'selected' : '' }}">1
                                                </li>
                                                <li data-value="2"
                                                    class="option {{ request('rooms') == '2' ? 'selected' : '' }}">2
                                                </li>
                                                <li data-value="3"
                                                    class="option {{ request('rooms') == '3' ? 'selected' : '' }}">3
                                                </li>
                                                <li data-value="4"
                                                    class="option {{ request('rooms') == '4' ? 'selected' : '' }}">4
                                                </li>
                                                <li data-value="5"
                                                    class="option {{ request('rooms') == '5' ? 'selected' : '' }}">5
                                                </li>
                                                <li data-value="6"
                                                    class="option {{ request('rooms') == '6' ? 'selected' : '' }}">6
                                                </li>
                                            </ul>
                                            <input type="hidden" name="rooms" value="{{ request('rooms') }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- Price Range Filter -->
                                <div class="form-group wg-box3">
                                    <div class="widget widget-price">
                                        <div class="caption flex-two">
                                            <div>
                                                <span class="fw-6">Price Range </span>
                                                <span id="slider-range-value1">{{ request('min_value', 100) }}</span>
                                                <span id="slider-range-value2">{{ request('max_value', 2000) }}</span>
                                            </div>
                                        </div>
                                        <div id="slider-range"></div>
                                        <div class="slider-labels">
                                            <div>
                                                <input type="hidden" id="min_value" name="min_value"
                                                    value="{{ request('min_value', 100) }}">
                                                <input type="hidden" id="max_value" name="max_value"
                                                    value="{{ request('max_value', 2000) }}">
                                            </div>
                                        </div>
                                    </div><!-- /.widget_price -->
                                </div>
                                <!-- Apply Filter Button -->
                                <input type="submit" class="filter_btn" value="Apply Filter">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Filter Form End -->
                <div class="flat-tabs themesflat-tabs">
                    <div class="content-tab">
                        <div class="content-inner tab-content">
                            <div class="wrap-item flex">
                                @foreach ($posts as $post)
                                    <a href="" class="card-link">
                                        @include('layouts.partial.home.post', ['post' => $post])
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
