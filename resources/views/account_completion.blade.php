@extends('layouts.master')

@section('title', 'Home Page')

@section('head_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
        href="{{ asset('app/css/account_completion.css') }}?v={{ filemtime(public_path('app/css/account_completion.css')) }}"
        rel="stylesheet" type="text/css" media="all" />
    <style>
        .error-border {
            border: 2px solid red;
        }

        .error-star::after {
            content: '*';
            color: red;
            margin-left: 5px;
        }
    </style>


@endsection

@section('content')
    <div id="pagee" class="clearfix">
        <section class="slider account_completion flat-contact tf-section home5 relative">
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

                            <ul class="step-navigation">
                                <li class="active" data-step="0">@lang('lang.step 1: your house information')</li>
                                <li data-step="1">@lang('lang.step 2: your house location')</li>
                                <li data-step="2">@lang('lang.step 3: your house gallery')</li>
                                <li data-step="3">@lang('lang.step 4: your interests')</li>
                            </ul>
                            <div class=" ml-auto mr-auto">
                                <h2>@lang('lang.your_house')</h2>
                            </div>
                            <br>
                            <br>
                            <form id="multiStepForm" action="{{ route('complete_account') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <!-- Step 1 -->
                                <div class="form-step form-step-active">

                                    <div class="form-row">
                                        <div class="form-group">
                                            <h3 class="price-label label">@lang('lang.rent price') (€)</h3>
                                            <input type="number" id="price" name="price"
                                                placeholder="@lang('lang.enter price')" class="input-field required" step="0.01"
                                                required>
                                        </div>
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
                                    </div>
                                    <div style="margin-top:30px "></div>
                                    <div class="form-group">
                                        <h3 class="rooms-label label">@lang('lang.number of rooms')</h3>
                                        <ul id="roomsList" class="roomsList-content required">
                                            @foreach ($numberOfRooms as $number)
                                                <li data-value="{{ $number['id'] }}">{{ $number['number'] }}</li>
                                            @endforeach
                                        </ul>
                                        <input type="hidden" id="numberOfRooms" name="number_of_rooms" value="">
                                    </div>
                                    <div style="margin-top:30px "></div>
                                </div>

                                <!-- Step 2 -->
                                <div class="form-step">

                                    <div class="form-row">

                                        <div class="form-group">
                                            <h3 class="post-code-label label">@lang('lang.post code')</h3>
                                            <input type="text" id="post_code" name="post_code"
                                                placeholder="@lang('lang.enter post code')" class="input-field required" required>
                                        </div>
                                        <div class="form-group">
                                            <h3 class="post-code-label label">@lang('lang.location')</h3>
                                            <input type="text" id="autocomplete" name="location_name"
                                                placeholder="@lang('lang.enter location name')" class="input-field required" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <h3 class="house-number-label label">@lang('lang.house number')</h3>
                                            <input type="text" id="house_number" name="house_number"
                                                placeholder="@lang('lang.enter house number')" class="input-field required" required>
                                        </div>
                                        <div class="form-group">
                                            <h3 class="street-label label">@lang('lang.street')</h3>
                                            <input type="text" id="street" name="street"
                                                placeholder="@lang('lang.enter street name')" class="input-field required">
                                        </div>


                                    </div>
                                </div>

                                <input type="hidden" id="latitude" name="latitude" value="">
                                <input type="hidden" id="longitude" name="longitude" value="">

                                <!-- Step 3 -->
                                <div class="form-step">
                                    <h3>@lang('lang.house gallery')</h3>
                                    <p style="margin-top:15px">@lang('lang.upload images of your house, other visitors can view those images'). (@lang('lang.optional'))</p>
                                    <input type="file" id="gallery" name="gallery[]" multiple class="input-field"
                                        style="margin-top:15px">
                                    <div class="preview-container">
                                        <div class="preview-slideshow" id="previewSlideshow"></div>
                                        <div class="preview-controls" id="previewControls">
                                            <button type="button" id="prevSlide" disabled>&#9664;</button>
                                            <button type="button" id="nextSlide" disabled>&#9654;</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Step 4 -->
                                <div class="form-step">
                                    <div class="form-row">
                                        <div class="form-group">
                                            <h3 class="post-code-label">@lang('lang.you want to go to')</h3>
                                            <input type="text" id="interestsAutocompleteInput"
                                                placeholder="@lang('lang.enter a location of interest')" class="input-field">
                                            <div class="tags-container" id="tagsContainer"></div>
                                            <input type="hidden" id="locationNames" name="location_names"
                                                value="" required>
                                        </div>
                                    </div>
                                    <input type="hidden" id="latitude" name="latitude" value="">
                                    <input type="hidden" id="longitude" name="longitude" value="">
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
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&loading=async&callback=initMap&language=nl">
    </script>
    <script>
        document.getElementById('post_code').addEventListener('input', function(e) {
            // Define a regular expression to match Arabic letters
            var arabicLetters = /[\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF]/g;

            // Remove any Arabic letters from the input value
            if (arabicLetters.test(e.target.value)) {
                e.target.value = e.target.value.replace(arabicLetters, '');
            }
        });
        document.getElementById('house_number').addEventListener('input', function(e) {
            // Define a regular expression to match Arabic letters
            var arabicLetters = /[\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF]/g;

            // Remove any Arabic letters from the input value
            if (arabicLetters.test(e.target.value)) {
                e.target.value = e.target.value.replace(arabicLetters, '');
            }
        });
        document.getElementById('street').addEventListener('input', function(e) {
            // Define a regular expression to match Arabic letters
            var arabicLetters = /[\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF]/g;

            // Remove any Arabic letters from the input value
            if (arabicLetters.test(e.target.value)) {
                e.target.value = e.target.value.replace(arabicLetters, '');
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const postCodeInput = document.getElementById('post_code');
            const houseNumberInput = document.getElementById('house_number');
            const apiKey = '{{ env('GOOGLE_MAPS_API_KEY') }}';

            function fetchCityFromPostCode() {
                const postCode = postCodeInput.value;
                if (postCode) {
                    fetch(
                            `https://maps.googleapis.com/maps/api/geocode/json?address=${postCode}&components=country:NL&language=ar&key=${apiKey}&language=nl`
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

                                if (!city) {
                                    // Use another API or method to get the city if Geocoding API didn't return it
                                    // fetchNearbyCity(postCode);
                                } else {
                                    document.getElementById('autocomplete').value = city;
                                }
                            } else {
                                console.error('Geocode was not successful for the following reason: ' + data
                                    .status);
                            }
                        })
                        .catch(error => console.error('Error fetching address:', error));
                }
            }


            function fetchStreetFromPostCodeAndHouseNumber() {
                const postCode = postCodeInput.value;
                const houseNumber = houseNumberInput.value;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                if (postCode && houseNumber) {
                    const address = `${houseNumber} ${postCode}, Netherlands`;

                    // Step 1: Get the Coordinates
                    fetch(
                            `https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(address)}&key=${apiKey}&language=nl`
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
                                            document.getElementById('street').value = data.street;
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
            }

            postCodeInput.addEventListener('input', fetchCityFromPostCode);
            houseNumberInput.addEventListener('input', fetchStreetFromPostCodeAndHouseNumber);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('multiStepForm');
            const steps = form.querySelectorAll('.form-step');
            const navItems = document.querySelectorAll('.step-navigation li');
            const nextButton = form.querySelector('.next');
            const prevButton = form.querySelector('.previous');
            const submitButton = form.querySelector('.submit');
            const houseTypeItems = document.querySelectorAll('#dropdownList li');
            const roomsItems = document.querySelectorAll('#roomsList li');
            const prevSlideButton = document.getElementById('prevSlide');
            const nextSlideButton = document.getElementById('nextSlide');
            let currentStep = 0;
            let currentSlide = 0;
            let images = [];

            function showStep(step) {
                steps.forEach((el, index) => {
                    el.classList.toggle('form-step-active', index === step);
                });

                navItems.forEach((el, index) => {
                    el.classList.toggle('active', index === step);
                    el.classList.toggle('completed', index < step);
                });

                prevButton.disabled = step === 0;
                nextButton.style.display = step === steps.length - 1 ? 'none' : 'inline-block';
                submitButton.style.display = step === steps.length - 1 ? 'inline-block' : 'none';
            }

            function validateStep(step) {
                const activeStep = steps[step];
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
                activeStep.querySelectorAll('ul.required').forEach(ul => {
                    const label = ul.closest('.form-group').querySelector('.label');
                    if (!ul.querySelector('li.active')) {
                        if (label) label.classList.add('error-star');
                        isValid = false;
                    } else {
                        if (label) label.classList.remove('error-star');
                    }

                    ul.addEventListener('click', () => {
                        if (ul.querySelector('li.active')) {
                            if (label) label.classList.remove('error-star');
                        }
                    });
                });

                return isValid;
            }

            function handleNextStep() {
                if (validateStep(currentStep)) {
                    currentStep++;
                    showStep(currentStep);
                }
            }

            navItems.forEach(item => {
                item.addEventListener('click', (e) => {
                    const step = parseInt(e.target.getAttribute('data-step'));
                    if (validateStep(currentStep)) {
                        currentStep = step;
                        showStep(currentStep);
                    }
                });
            });

            nextButton.addEventListener('click', handleNextStep);

            prevButton.addEventListener('click', () => {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            form.addEventListener('submit', (e) => {
                if (!validateStep(currentStep)) {
                    e.preventDefault();

                }
            });

            showStep(currentStep);

            // Initialize Google Map
            window.initMap = function() {
                const map = new google.maps.Map(document.getElementById('googleMap'), {
                    center: {
                        lat: -34.397,
                        lng: 150.644
                    },
                    zoom: 8
                });

                google.maps.event.addListener(map, 'click', function(event) {
                    document.getElementById('latitude').value = event.latLng.lat();
                    document.getElementById('longitude').value = event.latLng.lng();
                });
            };

            // House type selection
            houseTypeItems.forEach(item => {
                item.addEventListener('click', () => {
                    houseTypeItems.forEach(i => i.classList.remove('active', 'error-border'));
                    item.classList.add('active');
                    document.getElementById('houseType').value = item.getAttribute('data-value');
                    item.parentElement.previousElementSibling.classList.remove('error-star');
                });
            });

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


            // Dropdown functionality
            const dropdownInput = document.getElementById('dropdownInput');
            const dropdownList = document.getElementById('dropdownList');
            const dropdownItems = dropdownList.querySelectorAll('li');

            dropdownInput.addEventListener('click', () => {
                dropdownList.style.display = dropdownList.style.display === 'block' ? 'none' : 'block';
            });
            dropdownItems.forEach(item => {
                item.addEventListener('click', (e) => {
                    const value = e.target.getAttribute('data-value');
                    dropdownList.style.display = 'none';
                    dropdownInput.value = e.target.textContent;

                });
            });

        });
    </script>
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqpFnYM5ToiPcFtSC2SFMo55w3xNgViSQ&libraries=places&callback=initAutocomplete&language=nl">
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
                console.log(place);

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
