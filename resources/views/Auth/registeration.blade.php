@extends('layouts.master')

@section('title', 'Registration')

@section('head_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .stepper-wrapper {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            position: relative;
        }

        .stepper-item {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            text-align: center;
        }

        .stepper-item::before,
        .stepper-item::after {
            content: '';
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            border-top: 2px solid #ccc;
            width: 100%;
            height: 0;
            z-index: 1;
            transition: border-color 0.3s ease;
        }

        .stepper-item::before {
            left: -50%;
        }

        .stepper-item::after {
            left: 50%;
        }

        .stepper-item.completed::before,
        .stepper-item.completed::after,
        .stepper-item.active::before,
        .stepper-item.active::after {
            border-top-color: #2981B2;
        }

        .step-counter {
            position: relative;
            z-index: 5;
            display: inline-block;
            padding: 10px 40px;
            background-color: #ccc;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
            border: 2px solid transparent;
            clip-path: polygon(0 0, calc(100% - 20px) 0, 100% 50%, calc(100% - 20px) 100%, 0 100%, 20px 50%);
        }

        .stepper-item.active .step-counter,
        .stepper-item.completed .step-counter {
            background-color: #ffa920;
        }

        .stepper-item:first-child .step-counter::before {
            border-color: transparent #ffa920 transparent transparent;
        }

        .stepper-item:last-child .step-counter::after {
            border-color: transparent #ffa920 transparent transparent;
        }

        .stepper-item:first-child::before,
        .stepper-item:last-child::after {
            content: none;
        }

        .form-navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .form-navigation button {
            background: #2981B2;
            color: #fff;
            padding: 10px 30px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .form-navigation button[disabled] {
            background: #ccc;
        }

        .form-navigation .previous {
            background: #6c757d;
        }

        .form-navigation button:hover:not([disabled]) {
            background: #ffa920;
            transform: scale(1.05);
        }

        h3 {
            color: #2981B2;
            font-weight: bold;
        }

        @keyframes fadein {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .error-border {
            border: 2px solid red;
        }

        .error-star::after {
            content: '*';
            color: red;
            margin-left: 5px;
        }

        .required-field::before {
            content: '*';
            color: red;
            margin-right: 5px;
        }

        .dropdown-content,
        .multi-select-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content li,
        .multi-select-content li {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content li:hover,
        .multi-select-content li:hover {
            background-color: #f1f1f1;
        }

        .multi-select-content {
            max-height: 200px;
            overflow-y: auto;
        }

        .center-content {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: 100%;
        }

        .invalid-feedback {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }

        .wthree-text input[type="checkbox"] {
            margin-right: 10px;
        }

        .wthree-text input[type="checkbox"]:checked+span::before {
            content: "\2713";
            display: inline-block;
            color: #ffa920;
            margin-right: 5px;
        }
    </style>
    <link
        href="{{ asset('app/css/account_completion.css') }}?v={{ filemtime(public_path('app/css/account_completion.css')) }}"
        rel="stylesheet" type="text/css" media="all" />

@endsection

@section('content')
    <div id="pagee" class="clearfix">
        <section class="slider account_completion tf-section home5 relative">
            <div class="container parent_container">
                @if ($errors->any())
                    <div class="alert">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <div class="wrap-contact">
                            <div class="stepper-wrapper">
                                <div class="stepper-item completed">
                                    <div class="step-counter">Step 1</div>
                                </div>
                                <div class="stepper-item active progress-bar-half">
                                    <div class="step-counter">Step 2</div>
                                </div>
                                <div class="stepper-item">
                                    <div class="step-counter">Step 3</div>
                                </div>
                                <div class="stepper-item">
                                    <div class="step-counter">Step 4</div>
                                </div>

                            </div>
                            <hr>

                            <form id="multiStepForm" action="{{ route('post.register') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <!-- Step 1 -->
                                <div class="form-step form-step-active">
                                    <div class="row center-content">
                                        <h3 style="font-size: 24px !important;">@lang('lang.your_wishes')</h3>
                                    </div>

                                    <hr>
                                    <br>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <h3>@lang('lang.you want to go to')</h3>
                                            <input type="text" id="interestsAutocompleteInput"
                                                placeholder="@lang('lang.enter a location of interest')" class="input-field">
                                            <div class="tags-container" id="tagsContainer"></div>
                                            <input type="hidden" id="locationNames" name="location_names" value="" re
                                                quired>
                                        </div>
                                    </div>
                                    <div style="margin-top:30px "></div>
                                    <div class="form-row">

                                        <div class="form-group">
                                            <h3 class="house-type-label label">@lang('lang.house type')</h3>
                                            <div class="dropdown">
                                                <input type="text" id="dropdownInput_wish"
                                                    placeholder="@lang('lang.select an option')" readonly>
                                                <ul id="dropdownList_wish" class="dropdown-content required">
                                                    @foreach ($houseTypes as $type)
                                                        <li data-value="{{ $type['id'] }}">@lang('lang.' . $type['type'])</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <input type="hidden" id="houseType_wish" name="house_type_wish" value="">
                                        </div>
                                        <div class="form-group">
                                            <h3 class="price-label label">@lang('lang.rent price') (€)</h3>
                                            <input type="number" id="price_wish" name="price_wish"
                                                placeholder="@lang('lang.enter price')" class="input-field required" step="0.01"
                                                required>
                                        </div>
                                    </div>
                                    <div style="margin-top:30px "></div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <h3 class="rooms-label label">@lang('lang.number of rooms')</h3>
                                            <ul id="roomsList_wish" class="roomsList-content required">
                                                @foreach ($numberOfRooms as $number)
                                                    <li data-value="{{ $number['id'] }}">{{ $number['number'] }}</li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" id="numberOfRooms_wish" name="number_of_rooms_wish"
                                                value="">
                                        </div>
                                    </div>
                                    <div style="margin-top:30px "></div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <h3 class="area-label label">@lang('lang.area') (m²)</h3>
                                            <div class="dropdown">
                                                <input type="text" id="areaDropdownInput_wish"
                                                    placeholder="@lang('lang.select an option')" readonly>
                                                <ul id="areaDropdownList_wish" class="dropdown-content required">
                                                    @foreach ($areas as $area)
                                                        <li data-value="{{ $area }}">{{ $area }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <input type="hidden" id="area_wish" name="area_wish" value="">
                                        </div>

                                        <!-- New multi-select for house features -->
                                        <div class="form-group">
                                            <h3 class="features-label label">@lang('lang.house features')</h3>
                                            <div class="multi-select">
                                                <input type="text" id="featuresInput_wish"
                                                    placeholder="@lang('lang.specify house features')" readonly>
                                                <ul id="featuresList_wish" class="multi-select-content">
                                                    @foreach ($features as $feature)
                                                        <li data-name="{{ $feature['name'] }}"
                                                            data-value="{{ $feature['id'] }}">{{ $feature['name'] }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <input type="hidden" id="features_wish" name="features_wish"
                                                value="">
                                        </div>
                                    </div>
                                    <div style="margin-top:30px "></div>
                                </div>
                                <!-- Step 2 -->
                                <div class="form-step">
                                    <div class="row center-content">
                                        <h3 style="font-size: 24px !important;">@lang('lang.your_information')</h3>
                                    </div>
                                    <hr>
                                    <br>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <h3 class="label">@lang('lang.first name')</h3>
                                            <input class="text required input-field" type="text" name="first_name"
                                                placeholder="@lang('lang.first name')" required>
                                        </div>
                                        <div class="form-group">
                                            <h3 class="label">@lang('lang.last name')</h3>
                                            <input class="text email required input-field" type="text"
                                                name="last_name" placeholder="@lang('lang.last name')" required>
                                        </div>
                                    </div>
                                    <div style="margin-top:30px "></div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <h3 class="label">@lang('lang.email')</h3>
                                            <input class="text email required input-field" type="email" name="email"
                                                placeholder="@lang('lang.email')" required>
                                        </div>
                                        <div class="form-group">
                                            <h3 class="label">@lang('lang.phone number')</h3>
                                            <input class="text email required input-field" type="tel"
                                                name="phone_number" placeholder="@lang('lang.phone number')" required
                                                pattern="[0-9]{9,15}"
                                                title="Phone number must be between 10 to 15 digits">
                                        </div>
                                    </div>
                                    <div style="margin-top:30px "></div>
                                    <div class="form-row">
                                        {{-- <div class="form-group">
                                            <h3 class="label">@lang('lang.password')</h3>
                                            <input class="text required input-field" type="password" name="password"
                                                placeholder="@lang('lang.password')" required>
                                        </div>
                                        <div class="form-group">
                                            <h3 class="label">@lang('lang.confirm password')</h3>
                                            <input class="text required input-field" type="password"
                                                name="password_confirmation" placeholder="@lang('lang.confirm password')" required>
                                        </div> --}}
                                        <div class="form-group">
                                            <h3 class="label">@lang('lang.password')</h3>
                                            <input class="text required input-field" type="password" name="password"
                                                placeholder="@lang('lang.password')" required>
                                            <div class="invalid-feedback" id="passwordError"
                                                style="display: none; color: red;">Passwords do not match</div>
                                        </div>
                                        <div class="form-group">
                                            <h3 class="label">@lang('lang.confirm password')</h3>
                                            <input class="text required input-field" type="password"
                                                name="password_confirmation" placeholder="@lang('lang.confirm password')" required>
                                        </div>
                                    </div>
                                    <div style="margin-top:30px "></div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <div class="wthree-text">
                                                <label class="anim">
                                                    <input name="privacy_policy_and_terms_of_use" type="checkbox"
                                                        class="checkbox required" id="privacyPolicyCheckbox" required>
                                                    <span>
                                                        {!! __('lang.agree_text', [
                                                            'privacy_policy' =>
                                                                '<a style="color:#2981B2;" href="' .
                                                                route('privacy-policy') .
                                                                '" target="_blank">' .
                                                                __('lang.privacy_policy') .
                                                                '</a>',
                                                            'terms_of_use' => '',
                                                            // 'terms_of_use' => '<a href="" target="_blank">' . __('lang.terms_of_use') . '</a>',
                                                        ]) !!}
                                                    </span>
                                                </label>
                                                <div id="privacyPolicyError" class="invalid-feedback"
                                                    style="display: none;">
                                                    @lang('lang.agree_to_privacy_policy')
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div style="margin-top:30px "></div>
                                </div>
                                <!-- Step 3 -->
                                <div class="form-step">
                                    <div class="row center-content">
                                        <h3 style="font-size: 24px !important;">@lang('lang.your_house')</h3>
                                    </div>
                                    <hr>
                                    <br>
                                    <div class="form-row">

                                        <div class="form-group">
                                            <h3 class="post-code-label label">@lang('lang.post code')</h3>
                                            <input type="text" id="post_code" name="post_code"
                                                placeholder="@lang('lang.enter post code')" class="input-field required" required>
                                            <div id="post_code_hint" class="invalid-feedback" style="display: none;">
                                                @lang('lang.post_code_validation')
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h3 class="house-number-label label">@lang('lang.house number')</h3>
                                            <input type="text" id="house_number" name="house_number"
                                                placeholder="@lang('lang.enter house number')" class="input-field required" required>
                                        </div>
                                    </div>
                                    <div style="margin-top:30px "></div>
                                    <div class="form-row">

                                        <div class="form-group">
                                            <h3 class="post-code-label label">@lang('lang.location')</h3>
                                            <input type="text" id="autocomplete" name="location_name"
                                                placeholder="@lang('lang.enter location name')" class="input-field required" readonly>
                                        </div>
                                        <div class="form-group">
                                            <h3 class="street-label label">@lang('lang.street')</h3>
                                            <input type="text" id="street" name="street"
                                                placeholder="@lang('lang.enter street name')" class="input-field required">
                                        </div>


                                    </div>
                                    <div style="margin-top:30px "></div>
                                    <div class="form-row">

                                        <div class="form-group">
                                            <h3 class="house-type-label label">@lang('lang.house type')</h3>
                                            <div class="dropdown">
                                                <input type="text" id="dropdownInput" placeholder="@lang('lang.select an option')"
                                                    readonly>
                                                <ul id="dropdownList" class="dropdown-content required">
                                                    @foreach ($houseTypes as $type)
                                                        <li data-value="{{ $type['id'] }}">@lang('lang.' . $type['type'])</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <input type="hidden" id="houseType" name="house_type" value="">
                                        </div>
                                        <div class="form-group">
                                            <h3 class="price-label label">@lang('lang.rent price') (€)</h3>
                                            <input type="number" id="price" name="price"
                                                placeholder="@lang('lang.enter price')" class="input-field required"
                                                step="0.01" required>
                                        </div>
                                    </div>
                                    <div style="margin-top:30px "></div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <h3 class="rooms-label label">@lang('lang.number of rooms')</h3>
                                            <ul id="roomsList" class="roomsList-content required">
                                                @foreach ($numberOfRooms as $number)
                                                    <li data-value="{{ $number['id'] }}">{{ $number['number'] }}</li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" id="numberOfRooms" name="number_of_rooms"
                                                value="">
                                        </div>
                                    </div>
                                    <div style="margin-top:30px "></div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <h3 class="area-label label">@lang('lang.area') (m²)</h3>
                                            <div class="dropdown">
                                                <input type="text" id="areaDropdownInput"
                                                    placeholder="@lang('lang.select an option')" readonly>
                                                <ul id="areaDropdownList" class="dropdown-content required">
                                                    @foreach ($areas as $area)
                                                        <li data-value="{{ $area }}">{{ $area }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <input type="hidden" id="area" name="area" value="">
                                        </div>

                                        <!-- New multi-select for house features -->
                                        <div class="form-group">
                                            <h3 class="features-label label">@lang('lang.house features')</h3>
                                            <div class="multi-select">
                                                <input type="text" id="featuresInput" placeholder="@lang('lang.specify house features')"
                                                    readonly>
                                                <ul id="featuresList" class="multi-select-content">
                                                    @foreach ($features as $feature)
                                                        <li data-name="{{ $feature['name'] }}"
                                                            data-value="{{ $feature['id'] }}">{{ $feature['name'] }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <input type="hidden" id="features" name="features" value="">
                                        </div>
                                    </div>
                                    <div style="margin-top:30px"></div>
                                </div>
                                <!-- Step 4 -->
                                <div class="form-step">
                                    <div class="row center-content">
                                        <h3 style="font-size: 24px !important;">@lang('lang.more into your house')</h3>
                                    </div>
                                    <hr>
                                    <br>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <h3 class="description-label label">@lang('lang.house description')</h3>
                                            <textarea id="house_description" name="house_description" placeholder="@lang('lang.describe your house')"
                                                class="input-field required" rows="4" style="resize: none;"></textarea>
                                        </div>
                                    </div>
                                    <div style="margin-top:30px"></div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <h3>@lang('lang.house gallery')</h3>
                                            <p style="margin-top:15px">@lang('lang.add_house_picture')</p>
                                            <input type="file" id="gallery" name="gallery[]" multiple required
                                                class="input-field required" style="margin-top:15px">
                                            <div class="preview-container">
                                                <div class="preview-slideshow" id="previewSlideshow"></div>
                                                <div class="preview-controls" id="previewControls">
                                                    <button type="button" id="prevSlide" disabled>&#9664;</button>
                                                    <button type="button" id="nextSlide" disabled>&#9654;</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin-top:30px "></div>
                                </div>
                                <!-- Navigation Buttons -->
                                <div class="form-navigation">
                                    <button type="button" class="previous" disabled>@lang('lang.previous')</button>
                                    <button type="button" class="next">@lang('lang.next')</button>
                                    <button type="submit" class="submit"
                                        style="display: none;">@lang('lang.submit')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('additional_scripts')
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqpFnYM5ToiPcFtSC2SFMo55w3xNgViSQ&libraries=places&callback=initAutocomplete">
    </script>
    <script>
        let selectedCities = [];

        function initAutocomplete() {
            var interestsAutocompleteInput = document.getElementById('interestsAutocompleteInput');
            const tagsContainer = document.getElementById('tagsContainer');
            const locationNamesInput = document.getElementById('locationNames');

            var interestsAutocomplete = new google.maps.places.Autocomplete(interestsAutocompleteInput, {
                types: ['(cities)'],
                componentRestrictions: {
                    country: "NL"
                }
            });

            interestsAutocomplete.addListener('place_changed', function() {
                var place = interestsAutocomplete.getPlace();
                if (!place.place_id) {
                    alert("Please select a place from the dropdown list.");
                    return;
                }

                cityName = place.name;

                if (!selectedCities.includes(cityName)) {
                    selectedCities.push(cityName);
                    updateTagsContainer();
                }

                interestsAutocompleteInput.value = '';
            });

            function updateTagsContainer() {
                tagsContainer.innerHTML = '';
                selectedCities.forEach(city => {
                    const tag = document.createElement('div');
                    tag.className = 'tag';
                    tag.innerHTML = `${city} <span class="remove-tag">&times;</span>`;
                    tagsContainer.appendChild(tag);

                    tag.querySelector('.remove-tag').addEventListener('click', () => {
                        selectedCities = selectedCities.filter(c => c !== city);
                        updateTagsContainer();
                    });
                });

                locationNamesInput.value = selectedCities;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const postCodeInput = document.getElementById('post_code');
            const houseNumberInput = document.getElementById('house_number');
            const locationNameInput = document.getElementById('autocomplete');
            const streetInput = document.getElementById('street');
            const apiKey = '{{ env('GOOGLE_MAPS_API_KEY') }}';

            function validatePostCode(postCode) {
                const regex = /^[0-9]{4}[A-Za-z]{2}$/;
                return regex.test(postCode);
            }

            function showInvalidPostCode() {
                postCodeInput.classList.add('error-border');
                document.getElementById('post_code_hint').style.display = 'block';
            }

            function hideInvalidPostCode() {
                postCodeInput.classList.remove('error-border');
                document.getElementById('post_code_hint').style.display = 'none';
            }

            function fetchCityFromPostCode() {
                const postCode = postCodeInput.value;
                if (!validatePostCode(postCode)) {
                    showInvalidPostCode();
                    return;
                }

                hideInvalidPostCode();

                fetch(
                        `https://maps.googleapis.com/maps/api/geocode/json?address=${postCode}&components=country:NL&key=${apiKey}`
                    )
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'OK' && data.results.length > 0) {
                            let city = '';
                            let localityFound = false;

                            data.results[0].address_components.forEach(component => {
                                if (component.types.includes('locality')) {
                                    city = component.long_name;
                                    localityFound = true;
                                } else if (component.types.includes(
                                        'administrative_area_level_2') || component.types.includes(
                                        'administrative_area_level_3')) {
                                    if (!localityFound) {
                                        city = component.long_name;
                                    }
                                }
                            });

                            if (city) {
                                locationNameInput.value = city;
                                // Remove error star from label
                                locationNameInput.closest('.form-group').querySelector('.label').classList
                                    .remove('error-star');
                            }
                        } else {
                            console.error('Geocode was not successful for the following reason: ' + data
                                .status);
                        }
                    })
                    .catch(error => console.error('Error fetching address:', error));
            }

            function fetchStreetFromPostCodeAndHouseNumber() {
                const postCode = postCodeInput.value;
                const houseNumber = houseNumberInput.value;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                if (!validatePostCode(postCode)) {
                    showInvalidPostCode();
                    return;
                }

                hideInvalidPostCode();

                const address = `${houseNumber} ${postCode}, Netherlands`;

                // Step 1: Get the Coordinates
                fetch(
                        `https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(address)}&key=${apiKey}`
                    )
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'OK' && data.results.length > 0) {
                            const location = data.results[0].geometry.location;
                            const lat = location.lat;
                            const lng = location.lng;

                            // Step 2: Use the Coordinates to get place details and extract the street name
                            fetch('/get-place-details-by-coords', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': csrfToken
                                    },
                                    body: JSON.stringify({
                                        lat: lat,
                                        lng: lng
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.street) {
                                        streetInput.value = data.street;
                                        // Remove error star from label
                                        streetInput.closest('.form-group').querySelector('.label').classList
                                            .remove('error-star');
                                    } else {
                                        console.error('Failed to fetch street details:', data.error);
                                    }
                                })
                                .catch(error => console.error('Error fetching place details:', error));
                        } else {
                            console.error('Geocode was not successful for the following reason: ' + data
                                .status);
                        }
                    })
                    .catch(error => console.error('Error fetching address:', error));
            }

            postCodeInput.addEventListener('input', function() {
                const postCode = postCodeInput.value;
                if (validatePostCode(postCode)) {
                    hideInvalidPostCode();
                    fetchCityFromPostCode();
                } else {
                    showInvalidPostCode();
                }
            });

            houseNumberInput.addEventListener('input', function() {
                const postCode = postCodeInput.value;
                if (validatePostCode(postCode)) {
                    fetchStreetFromPostCodeAndHouseNumber();
                }
            });

            // Remove error star when values are programmatically updated
            locationNameInput.addEventListener('change', function() {
                if (locationNameInput.value) {
                    locationNameInput.closest('.form-group').querySelector('.label').classList.remove(
                        'error-star');
                }
            });
            streetInput.addEventListener('change', function() {
                if (streetInput.value) {
                    streetInput.closest('.form-group').querySelector('.label').classList.remove(
                        'error-star');
                }
            });

            postCodeInput.addEventListener('input', function(e) {
                // Define a regular expression to match Arabic letters
                var arabicLetters = /[\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF]/g;

                // Remove any Arabic letters from the input value
                if (arabicLetters.test(e.target.value)) {
                    e.target.value = e.target.value.replace(arabicLetters, '');
                }
            });

            houseNumberInput.addEventListener('input', function(e) {
                // Define a regular expression to match Arabic letters
                var arabicLetters = /[\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF]/g;

                // Remove any Arabic letters from the input value
                if (arabicLetters.test(e.target.value)) {
                    e.target.value = e.target.value.replace(arabicLetters, '');
                }
            });

            streetInput.addEventListener('input', function(e) {
                // Define a regular expression to match Arabic letters
                var arabicLetters = /[\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF]/g;

                // Remove any Arabic letters from the input value
                if (arabicLetters.test(e.target.value)) {
                    e.target.value = e.target.value.replace(arabicLetters, '');
                }
            });

            document.getElementById('interestsAutocompleteInput').addEventListener('input', function(e) {
                // Regular expression to detect Arabic characters
                var arabicPattern = /[\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF\uFB50-\uFDFF\uFE70-\uFEFF]/;

                // If the input contains Arabic characters, remove them
                if (arabicPattern.test(e.target.value)) {
                    e.target.value = e.target.value.replace(arabicPattern, '');
                }
            });

            // Prevent form submission on Enter key press in the interestsAutocompleteInput field
            document.getElementById('interestsAutocompleteInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                }
            });

            // Dropdown functionality
            const dropdownInput_wish = document.getElementById('dropdownInput_wish');
            const dropdownList_wish = document.getElementById('dropdownList_wish');
            const dropdownItems_wish = dropdownList_wish.querySelectorAll('li');

            dropdownInput_wish.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownList_wish.style.display = dropdownList_wish.style.display === 'block' ? 'none' :
                    'block';
            });
            dropdownItems_wish.forEach(item => {
                item.addEventListener('click', (e) => {
                    const value = e.target.getAttribute('data-value');
                    dropdownList_wish.style.display = 'none';
                    dropdownInput_wish.value = e.target.textContent;
                    document.getElementById('houseType_wish').value = value;
                });
            });

            // Area dropdown functionality
            const areaDropdownInput_wish = document.getElementById('areaDropdownInput_wish');
            const areaDropdownList_wish = document.getElementById('areaDropdownList_wish');
            const areaDropdownItems_wish = areaDropdownList_wish.querySelectorAll('li');

            areaDropdownInput_wish.addEventListener('click', (e) => {
                e.stopPropagation();
                areaDropdownList_wish.style.display = areaDropdownList_wish.style.display === 'block' ?
                    'none' :
                    'block';
            });
            areaDropdownItems_wish.forEach(item => {
                item.addEventListener('click', (e) => {
                    const value = e.target.getAttribute('data-value');
                    areaDropdownList_wish.style.display = 'none';
                    areaDropdownInput_wish.value = e.target.textContent;
                    document.getElementById('area_wish').value = value;
                });
            });

            // Multi-select functionality
            const featuresInput_wish = document.getElementById('featuresInput_wish');
            const featuresList_wish = document.getElementById('featuresList_wish');
            const featuresItems_wish = featuresList_wish.querySelectorAll('li');
            let selectedFeatures_wish = [];
            let selectedFeaturesNames_wish = [];

            featuresInput_wish.addEventListener('click', (e) => {
                e.stopPropagation();
                featuresList_wish.style.display = featuresList_wish.style.display === 'block' ? 'none' :
                    'block';
            });
            featuresItems_wish.forEach(item => {
                item.addEventListener('click', (e) => {
                    const value = e.target.getAttribute('data-value');
                    const name = e.target.getAttribute('data-name');
                    if (selectedFeatures_wish.includes(value)) {
                        selectedFeatures_wish = selectedFeatures_wish.filter(feature => feature !==
                            value);
                        e.target.style.backgroundColor = ''; // Reset background color if unselected
                    } else {
                        selectedFeatures_wish.push(value);
                        selectedFeaturesNames_wish.push(name);
                        e.target.style.backgroundColor = '#ffa920'; // Highlight selected items
                    }
                    featuresInput_wish.value = selectedFeaturesNames_wish.join(', ');
                    document.getElementById('features_wish').value = selectedFeatures_wish.join(
                        ', ');
                });
            });

            // Dropdown functionality
            const dropdownInput = document.getElementById('dropdownInput');
            const dropdownList = document.getElementById('dropdownList');
            const dropdownItems = dropdownList.querySelectorAll('li');

            dropdownInput.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownList.style.display = dropdownList.style.display === 'block' ? 'none' : 'block';
            });
            dropdownItems.forEach(item => {
                item.addEventListener('click', (e) => {
                    const value = e.target.getAttribute('data-value');
                    dropdownList.style.display = 'none';
                    dropdownInput.value = e.target.textContent;
                    document.getElementById('houseType').value = value;
                });
            });

            // Area dropdown functionality
            const areaDropdownInput = document.getElementById('areaDropdownInput');
            const areaDropdownList = document.getElementById('areaDropdownList');
            const areaDropdownItems = areaDropdownList.querySelectorAll('li');

            areaDropdownInput.addEventListener('click', (e) => {
                e.stopPropagation();
                areaDropdownList.style.display = areaDropdownList.style.display === 'block' ? 'none' :
                    'block';
            });
            areaDropdownItems.forEach(item => {
                item.addEventListener('click', (e) => {
                    const value = e.target.getAttribute('data-value');
                    areaDropdownList.style.display = 'none';
                    areaDropdownInput.value = e.target.textContent;
                    document.getElementById('area').value = value;
                });
            });

            // Multi-select functionality
            const featuresInput = document.getElementById('featuresInput');
            const featuresList = document.getElementById('featuresList');
            const featuresItems = featuresList.querySelectorAll('li');
            let selectedFeatures = [];
            let selectedFeaturesNames = [];

            featuresInput.addEventListener('click', (e) => {
                e.stopPropagation();
                featuresList.style.display = featuresList.style.display === 'block' ? 'none' : 'block';
            });
            featuresItems.forEach(item => {
                item.addEventListener('click', (e) => {
                    const value = e.target.getAttribute('data-value');
                    const name = e.target.getAttribute('data-name');
                    if (selectedFeatures.includes(value)) {
                        selectedFeatures = selectedFeatures.filter(feature => feature !== value);
                        e.target.style.backgroundColor = ''; // Reset background color if unselected
                    } else {
                        selectedFeatures.push(value);
                        selectedFeaturesNames.push(name);
                        e.target.style.backgroundColor = '#ffa920'; // Highlight selected items
                    }
                    featuresInput.value = selectedFeaturesNames.join(', ');
                    document.getElementById('features').value = selectedFeatures.join(', ');
                });
            });

            document.addEventListener('click', (e) => {
                // Close all dropdowns and multi-selects
                dropdownList.style.display = 'none';
                areaDropdownList.style.display = 'none';
                featuresList.style.display = 'none';

                dropdownList_wish.style.display = 'none';
                areaDropdownList_wish.style.display = 'none';
                featuresList_wish.style.display = 'none';
            });

            const steps = document.querySelectorAll('.stepper-item');
            const nextButton = document.querySelector('.next');
            const prevButton = document.querySelector('.previous');
            const submitButton = document.querySelector('.submit');
            const formSteps = document.querySelectorAll('.form-step');
            let currentStep = 0;

            function updateStepProgress() {
                steps.forEach((step, index) => {
                    if (index < currentStep) {
                        step.classList.add('completed');
                        step.classList.remove('active');
                    } else if (index === currentStep) {
                        step.classList.add('active');
                        step.classList.remove('completed');
                    } else {
                        step.classList.remove('active', 'completed');
                    }
                });
                formSteps.forEach((step, index) => {
                    if (index === currentStep) {
                        step.classList.add('form-step-active');
                    } else {
                        step.classList.remove('form-step-active');
                    }
                });

                prevButton.disabled = currentStep === 0;
                nextButton.style.display = currentStep === steps.length - 1 ? 'none' : 'inline-block';
                submitButton.style.display = currentStep === steps.length - 1 ? 'inline-block' : 'none';
            }

            nextButton.addEventListener('click', () => {
                if (currentStep < steps.length - 1 && validateStep(currentStep)) {
                    currentStep++;
                    updateStepProgress();
                }
            });

            prevButton.addEventListener('click', () => {
                if (currentStep > 0) {
                    currentStep--;
                    updateStepProgress();
                }
            });

            updateStepProgress();

            function validateStep(step) {
                const activeStep = formSteps[step];
                let isValid = true;

                activeStep.querySelectorAll('input.required').forEach(field => {
                    const label = field.closest('.form-group').querySelector('.label');
                    if (!field.value) {
                        if (label) label.classList.add('error-star');
                        isValid = false;
                    } else {
                        if (label) label.classList.remove('error-star');
                    }

                    field.addEventListener('input', () => {
                        if (field.value) {
                            if (label) label.classList.remove('error-star');
                        }
                    });
                });

                // Validate dropdown lists
                activeStep.querySelectorAll('.dropdown-content.required').forEach(dropdown => {
                    const input = dropdown.previousElementSibling;
                    const label = input.closest('.form-group').querySelector('.label');
                    if (!input.value) {
                        if (label) label.classList.add('error-star');
                        isValid = false;
                    } else {
                        if (label) label.classList.remove('error-star');
                    }

                    dropdown.addEventListener('click', () => {
                        if (input.value) {
                            if (label) label.classList.remove('error-star');
                        }
                    });
                });

                // Validate room list
                activeStep.querySelectorAll('.roomsList-content.required').forEach(roomList => {
                    const input = roomList.nextElementSibling;
                    const label = roomList.closest('.form-group').querySelector('.label');
                    if (!input.value) {
                        if (label) label.classList.add('error-star');
                        isValid = false;
                    } else {
                        if (label) label.classList.remove('error-star');
                    }

                    roomList.addEventListener('click', () => {
                        if (input.value) {
                            if (label) label.classList.remove('error-star');
                        }
                    });
                });
                // Validate privacy policy checkbox
                const privacyPolicyCheckbox = document.getElementById('privacyPolicyCheckbox');
                const privacyPolicyError = document.getElementById('privacyPolicyError');
                if (privacyPolicyCheckbox && !privacyPolicyCheckbox.checked && currentStep == 1) {
                    privacyPolicyError.style.display = 'block';
                    isValid = false;
                } else {
                    privacyPolicyError.style.display = 'none';
                }

                if (currentStep === 1) {
                    const password = document.querySelector('input[name="password"]');
                    const confirmPassword = document.querySelector('input[name="password_confirmation"]');
                    const passwordError = document.getElementById('passwordError');

                    if (password.value && confirmPassword.value) {
                        if (password.value !== confirmPassword.value) {
                            password.closest('.form-group').querySelector('.label').classList.add('error-star');
                            confirmPassword.closest('.form-group').querySelector('.label').classList.add(
                                'error-star');
                            passwordError.style.display = 'block';
                            isValid = false;
                        } else {
                            password.closest('.form-group').querySelector('.label').classList.remove('error-star');
                            confirmPassword.closest('.form-group').querySelector('.label').classList.remove(
                                'error-star');
                            passwordError.style.display = 'none';
                        }
                    }
                }
                return isValid;
            }

            const roomsItems = document.querySelectorAll('#roomsList li');
            // Rooms number selection
            roomsItems.forEach(item => {
                item.addEventListener('click', () => {
                    roomsItems.forEach(i => i.classList.remove('active', 'error-border'));
                    item.classList.add('active');
                    document.getElementById('numberOfRooms').value = item.getAttribute(
                        'data-value');
                    item.parentElement.previousElementSibling.classList.remove('error-star');
                });
            });

            const roomsItems_wish = document.querySelectorAll('#roomsList_wish li');
            // Rooms number selection
            roomsItems_wish.forEach(item => {
                item.addEventListener('click', () => {
                    roomsItems_wish.forEach(i => i.classList.remove('active', 'error-border'));
                    item.classList.add('active');
                    document.getElementById('numberOfRooms_wish').value = item.getAttribute(
                        'data-value');
                    item.parentElement.previousElementSibling.classList.remove('error-star');
                });
            });

            const prevSlideButton = document.getElementById('prevSlide');
            const nextSlideButton = document.getElementById('nextSlide');
            let currentSlide = 0;
            let images = [];

            // Handle gallery upload and preview
            document.getElementById('gallery').addEventListener('change', function(event) {
                const files = event.target.files;
                images = [];
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        images.push(e.target.result);
                        updateSlideshow();
                    };
                    reader.readAsDataURL(file);
                });

                if (files.length > 0) {
                    document.querySelector('.preview-container').style.display = 'flex';
                    document.getElementById('previewControls').style.display = 'flex';
                    prevSlideButton.disabled = true;
                    nextSlideButton.disabled = images.length <= 5;
                } else {
                    document.querySelector('.preview-container').style.display = 'none';
                    document.getElementById('previewControls').style.display = 'none';
                }
            });

            function updateSlideshow() {
                const slideshow = document.getElementById('previewSlideshow');
                slideshow.innerHTML = '';
                const visibleImages = images.slice(currentSlide, currentSlide + 5);
                visibleImages.forEach(src => {
                    const img = document.createElement('img');
                    img.src = src;
                    slideshow.appendChild(img);
                });

                prevSlideButton.disabled = currentSlide === 0;
                nextSlideButton.disabled = currentSlide >= images.length - 5;
            }

            prevSlideButton.addEventListener('click', () => {
                if (currentSlide > 0) {
                    currentSlide--;
                    updateSlideshow();
                }
            });

            nextSlideButton.addEventListener('click', () => {
                if (currentSlide < images.length - 5) {
                    currentSlide++;
                    updateSlideshow();
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function() {
                    createPreloader();
                });
            }
        });

        // Remove preloader after the page is fully loaded
        window.addEventListener('load', function() {
            removePreloader();
        });
    </script>
@endsection
