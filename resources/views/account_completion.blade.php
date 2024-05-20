@extends('layouts.master')

@section('title', 'Home Page')

@section('head_css')
    <link
        href="{{ asset('app/css/account_completion.css') }}?v={{ filemtime(public_path('app/css/account_completion.css')) }}"
        rel="stylesheet" type="text/css" media="all" />
    <style>
        .error-border {
            border: 1px solid red;
        }

        .error-star::after {
            content: '*';
            color: red;
            margin-left: 5px;
        }

        .dropdown {
            position: relative;
            width: 100%;
            /* margin: 10px 0; */
        }

        .dropdown input[type="text"] {
            width: calc(100% - 20px);
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            color: #2981B2;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 100%;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            z-index: 1;
            border-radius: 10px;
            max-height: 200px;
            overflow-y: auto;
        }

        .dropdown-content li {
            padding: 12px 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            color: #2981B2;
        }

        .dropdown-content li:hover {
            background-color: #f1f1f1;
            color: #FF9700;
        }
    </style>
@endsection

@section('content')
    <div id="pagee" class="clearfix">
        <section class="slider flat-contact tf-section home5 relative">
            <div class="container parent_container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="wrap-contact">
                            <ul class="step-navigation">
                                <li class="active" data-step="0">Step 1: House Information</li>
                                <li data-step="1">Step 2: House Location</li>
                                <li data-step="2">Step 3: House Gallery</li>
                            </ul>
                            <form id="multiStepForm" action="{{ route('complete_account') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <!-- Step 1 -->
                                <div class="form-step form-step-active">

                                    {{-- <ul id="houseTypeList" class="houseTypeList-content">
                                        @foreach ($houseTypes as $type)
                                            <li data-value="{{ $type['id'] }}">{{ $type['type'] }}</li>
                                        @endforeach
                                    </ul> --}}

                                    <div class="form-row">
                                        <div class="form-group">
                                            <h3 class="price-label">Rent Price (€)</h3>
                                            <input type="number" id="price" name="price" placeholder="Enter price"
                                                class="input-field" step="0.01" required>

                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" id="houseType" name="house_type" value="">

                                            <h3 class="house-type-label">House Type</h3>
                                            <div class="dropdown">

                                                <input type="text" id="dropdownInput" placeholder="Select an option"
                                                    readonly>
                                                <ul id="dropdownList" class="dropdown-content">
                                                    @foreach ($houseTypes as $type)
                                                        <li data-value="{{ $type['id'] }}">{{ $type['type'] }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                        </div>
                                        {{-- <div class="form-group">
                                            <h3 class="area-label">Area (sqm)</h3>
                                            <input type="number" id="area" name="area" placeholder="Enter area"
                                                class="input-field" required>
                                        </div> --}}
                                    </div>
                                    <div style="margin-top:30px "></div>
                                    <h3 class="rooms-label">Number of rooms</h3>
                                    <ul id="roomsList" class="roomsList-content">
                                        @foreach ($numberOfRooms as $number)
                                            <li data-value="{{ $number['id'] }}">{{ $number['number'] }}</li>
                                        @endforeach
                                    </ul>
                                    <input type="hidden" id="numberOfRooms" name="number_of_rooms" value="">

                                    <div style="margin-top:30px "></div>


                                </div>
                                <!-- Step 2 -->
                                <div class="form-step">
                                    <div class="form-row">
                                        <div class="form-group">
                                            <h3 class="location-label">Location</h3>
                                            <input type="text" id="locationName" name="location_name"
                                                placeholder="Enter location name" class="input-field" required>
                                        </div>
                                        <div class="form-group">
                                            <h3 class="post-code-label">Post Code</h3>
                                            <input type="text" name="post_code" placeholder="Enter post code"
                                                class="input-field" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <h3 class="street-label">Street</h3>
                                            <input type="text" name="street" placeholder="Enter street name"
                                                class="input-field">
                                        </div>
                                        <div class="form-group">
                                            <h3 class="house-number-label">House Number</h3>
                                            <input type="text" name="house_number" placeholder="Enter house number"
                                                class="input-field" required>
                                        </div>
                                    </div>
                                    <input type="hidden" id="latitude" name="latitude" value="">
                                    <input type="hidden" id="longitude" name="longitude" value="">

                                    {{-- <div class="switch-container">
                                        <label class="switch-label" for="locationSwitch">Allow Street View for Google
                                            Maps?</label>
                                        <label class="switch">
                                            <input type="checkbox" id="locationSwitch" name="street_view">
                                            <span class="location_slider"></span>
                                        </label>
                                    </div>
                                    <div id="googleMap" class="google-map"></div> --}}
                                </div>
                                <!-- Step 3 -->
                                <div class="form-step">
                                    <h3>House Gallery</h3>
                                    <input type="file" id="gallery" name="gallery[]" multiple class="input-field">
                                    <div class="preview-container">
                                        <div class="preview-slideshow" id="previewSlideshow"></div>
                                        <div class="preview-controls" id="previewControls">
                                            <button type="button" id="prevSlide" disabled>&#9664;</button>
                                            <button type="button" id="nextSlide" disabled>&#9654;</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Navigation Buttons -->
                                <div class="form-navigation">
                                    <button type="button" class="previous" disabled>Previous</button>
                                    <button type="button" class="next">Next</button>
                                    <button type="submit" class="submit" style="display: none;">Submit</button>
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
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&loading=async&callback=initMap">
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
                    const label = field.previousElementSibling;
                    if (!field.value) {
                        field.classList.add('error-border');
                        label.classList.add('error-star');
                        isValid = false;
                    } else {
                        field.classList.remove('error-border');
                        label.classList.remove('error-star');
                    }

                    field.addEventListener('input', () => {
                        if (field.value) {
                            field.classList.remove('error-border');
                            label.classList.remove('error-star');
                        }
                    });
                });

                activeStep.querySelectorAll('ul.required').forEach(ul => {
                    const label = ul.previousElementSibling;
                    if (!ul.querySelector('li.active')) {
                        ul.classList.add('error-border');
                        label.classList.add('error-star');
                        isValid = false;
                    } else {
                        ul.classList.remove('error-border');
                        label.classList.remove('error-star');
                    }
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
@endsection
