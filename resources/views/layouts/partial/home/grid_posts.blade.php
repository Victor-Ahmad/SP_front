<section class="flat-featured wg-dream home5">
    <div class="container3">
        <div class="row">
            <div class="col-lg-12 background_white">

                <div class="heading-section center">
                    <h2 class="heading_title">@lang('lang.available houses')</h2>
                </div>
                @if ($progress['progress'] != '100 %')
                    <div class="progress-container">
                        <div class="progress-circle">
                            <svg viewBox="0 0 100 100">
                                <circle class="background" cx="50" cy="50" r="45"></circle>
                                <circle class="foreground" cx="50" cy="50" r="45"></circle>
                            </svg>
                            <div class="progress-text" id="progress-text"></div>
                        </div>
                        @php
                            $type = 0;
                            if (empty($progress['missing_steps'])) {
                                $type = 0;
                            } elseif (count($progress['missing_steps']) > 1) {
                                $type = 3;
                            } elseif ($progress['missing_steps'][0] === 'Images') {
                                $type = 2;
                            } else {
                                $type = 1;
                            }
                        @endphp
                        <div class="missing-steps">
                            <P>@lang('lang.complete_your_account_to_get_better_house_exchange_matches') </P>
                            <a href="{{ route('profile.compelete.get', ['type' => $type]) }}">@lang('lang.go_profile')</a>
                            {{-- @foreach ($progress['missing_steps'] as $step)
                                <a href="{{ route('profile.get') }}">{{ $step }}</a>
                            @endforeach --}}
                        </div>
                    </div>
                @endif

                <button class="filter-toggle-btn" onclick="toggleFilter()">Filter</button>

                <!-- Filter Form Start -->

                <div class="content-inner tab-content flex-center filter-form-container">
                    <div class="form-sl col-md-12 form-sl-spaced">
                        <form method="GET" action="{{ route('home') }}" class="filter-form">
                            <div class="wd-find-select flex">
                                <!-- Location Dropdown -->
                                <div class="form-group form-style">
                                    <div class="group-select">
                                        <input type="text" id="searchAutocompleteInput" name="location"
                                            placeholder="@lang('lang.enter a location to look for')" class=" nice-select"
                                            value="{{ request('location') }}">

                                    </div>
                                </div>

                                <!-- Rooms Dropdown -->
                                <div class="form-group form-style">
                                    <div class="group-select small_width_field">
                                        <div class="nice-select small_width_field" tabindex="0">
                                            <span
                                                class="current">{{ request('rooms', __('lang.rooms') . ': ' . __('lang.any')) }}</span>
                                            <ul class="list small_width_field">
                                                <li data-value="any"
                                                    class="option {{ request('rooms') == 'any' ? 'selected' : '' }}">
                                                    @lang('lang.any')
                                                </li>
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
                                                    class="option {{ request('rooms') == '5' ? 'selected' : '' }}">
                                                    5
                                                </li>
                                                <li data-value="6"
                                                    class="option {{ request('rooms') == '6' ? 'selected' : '' }}">
                                                    6
                                                </li>
                                            </ul>
                                            <input type="hidden" name="rooms" value="{{ request('rooms') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-style">
                                    <div class="group-select small_width_field">
                                        <span class="value"><input type="number" step="5"
                                                placeholder="@lang('lang.min_value')" id="min_value" name="min_value"
                                                value="{{ request('min_value', null) }}" class="editable"></span>

                                    </div>
                                </div>
                                <div class="form-group form-style">
                                    <div class="group-select small_width_field">
                                        <span class="value"><input type="number" step="5"
                                                placeholder="@lang('lang.max_value')" id="max_value" name="max_value"
                                                value="{{ request('max_value', null) }}" class="editable"></span>

                                    </div>
                                </div>

                                <!-- Apply Filter Button -->
                                <div class="form-group form-style">
                                    <input type="submit" class="filter_btn" value="@lang('lang.apply filter')">
                                    <button type="button" class="clear_filter_btn"
                                        onclick="clearFilters()">@lang('lang.clear all')
                                    </button>
                                </div>
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
                                    {{-- <a href="{{ route('getPost', $post['id']) }}" class="card-link"> --}}
                                    {{-- <a href="javascript:openGallery('{{ json_encode($post['images']) }}');"
                                        class="card-link"> --}}


                                    <a href="{{ route('getPost', $post['id']) }}" class="card-link">

                                        @include('layouts.partial.home.post', ['post' => $post])
                                    </a>
                                @endforeach
                            </div>
                            @if (empty($posts))
                                <div class="row justify-content-center align-items-center" style="min-height: 50vh;">
                                    <div class="col-12">
                                        <div class="no-results">
                                            @lang('lang.no matches found for your search criteria')
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="galleryModal" class="modal">
    <span class="close" onclick="closeGallery()">&times;</span>
    <div class="modal-content">
        <div class="modal-slide">
            <!-- Images will be dynamically added here -->
        </div>
        <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
        <a class="next" onclick="changeSlide(1)">&#10095;</a>
    </div>
</div>
