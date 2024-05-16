@extends('layouts.master')

@section('title', 'Home Page')

@section('head_css')
    <style>
        body {
            background: #f4f7f6;
            font-family: 'Arial', sans-serif;
        }

        .wrap-contact {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .wrap-contact:hover {
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
        }

        .step-navigation {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            padding: 0;
            list-style: none;
            background: #6e55ff;
            border-radius: 20px;
            position: relative;
        }

        .step-navigation li {
            flex: 1;
            text-align: center;
            position: relative;
            padding: 15px 0;
            cursor: pointer;
            font-weight: bold;
            color: #fff;
            transition: background 0.3s ease;
        }

        .step-navigation li.active,
        .step-navigation li.completed {
            background: #ffa920;
        }

        .step-navigation li:hover {
            background: #e18a00;
        }

        .step-navigation::before {
            content: "";
            width: 100%;
            height: 4px;
            background-color: #ccc;
            position: absolute;
            bottom: -1px;
            left: 0;
        }

        .step-navigation li.active::after,
        .step-navigation li.completed::after {
            background-color: #6e55ff;
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 4px;
            content: "";
        }

        .form-step {
            display: none;
            animation: fadein 0.5s;
        }

        .form-step-active {
            display: block;
        }

        .form-navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .form-navigation button {
            background: #6e55ff;
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
            background: #5935ff;
            transform: scale(1.05);
        }

        input[type="text"] {
            width: calc(100% - 20px);
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 10px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            color: #6e55ff;
        }

        input[type="text"]:focus {
            border-color: #6e55ff;
            box-shadow: 0 0 5px rgba(110, 85, 255, 0.5);
            outline: none;
            color: #6e55ff;
        }

        h3 {
            color: #6e55ff;
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

        .dropdown {
            position: relative;
            width: 100%;
            margin: 10px 0;
        }

        .dropdown input[type="text"] {
            width: calc(100% - 20px);
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            color: #6e55ff;
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
            color: #6e55ff;
        }

        .dropdown-content li:hover {
            background-color: #f1f1f1;
            color: #e18a00;
        }

        .explanation {
            margin-bottom: 20px;
            padding: 15px;
            color: #e18a00;
            display: none;
        }

        .parent_container {
            min-height: 85vh;
        }

        .rooms_slider-container,
        .price_slider-container,
        .area_slider-container {
            width: calc(100% - 20px);
            margin: 10px 0;
        }

        .slider-label {
            font-weight: bold;
            color: #6e55ff;
        }

        .rooms_slider,
        .price_slider,
        .area_slider {
            -webkit-appearance: none;
            appearance: none;
            width: 100%;
            height: 10px;
            border-radius: 5px;
            background: #d3d3d3;
            outline: none;
            opacity: 0.9;
            transition: opacity .2s;
        }

        .rooms_slider:hover,
        .price_slider:hover,
        .area_slider:hover {
            opacity: 1;
        }

        .rooms_slider::-webkit-slider-thumb,
        .price_slider::-webkit-slider-thumb,
        .area_slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #6e55ff;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .rooms_slider::-webkit-slider-thumb:hover,
        .price_slider::-webkit-slider-thumb:hover,
        .area_slider::-webkit-slider-thumb:hover {
            background: #5935ff;
        }

        .rooms_slider::-moz-range-thumb,
        .price_slider::-moz-range-thumb,
        .area_slider::-moz-range-thumb {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #6e55ff;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .rooms_slider::-moz-range-thumb:hover,
        .price_slider::-moz-range-thumb:hover,
        .area_slider::-moz-range-thumb:hover {
            background: #5935ff;
        }

        .slider-value {
            font-weight: bold;
            color: #6e55ff;
        }

        .switch-container {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }

        .switch-label {
            margin-right: 10px;
            font-weight: bold;
            color: #6e55ff;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .location_slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .location_slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.location_slider {
            background-color: #6e55ff;
        }

        input:checked+.location_slider:before {
            transform: translateX(26px);
        }

        .google-map {
            width: 100%;
            height: 300px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin: 10px 0;
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
                                <li class="active" data-step="0">Step 1</li>
                                <li data-step="1">Step 2</li>
                                <li data-step="2">Step 3</li>
                                <li data-step="3">Step 4</li>
                                <li data-step="4">Step 5</li>
                            </ul>
                            <form id="multiStepForm">
                                <!-- Step 1 -->
                                <div class="form-step form-step-active">
                                    <h3>Swap Type</h3>
                                    <!-- Dropdown List -->
                                    <div class="dropdown">
                                        <input type="text" id="dropdownInput" placeholder="Select an option" readonly>
                                        <ul id="dropdownList" class="dropdown-content">
                                            <li data-value="1">1 to 1: Exchange your house for someone else's</li>
                                            <li data-value="2">1 to 2: Exchange one house for two other houses</li>
                                            <li data-value="3">2 to 1: Exchange two houses for one</li>
                                        </ul>
                                    </div>
                                    <div id="explanationText" class="explanation"></div>
                                </div>
                                <!-- Step 2 -->
                                <div class="form-step">
                                    <h3>House Information</h3>
                                    <div class="dropdown">
                                        <input type="text" id="dropdownInput2" placeholder="Select an option" readonly>
                                        <ul id="dropdownList2" class="dropdown-content">
                                            @foreach ($houseTypes as $type)
                                                <li data-value="{{ $type['id'] }}">{{ $type['type'] }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- Slider for Number of Rooms -->
                                    <h3 class="slider-label">Number of Rooms:</h3>
                                    <div class="rooms_slider-container">
                                        <input type="range" id="roomSlider" name="room_slider" min="1"
                                            max="6" value="1" class="rooms_slider">
                                        <span id="sliderValue" class="slider-value">1</span>
                                    </div>
                                    <!-- Slider for Price Range -->
                                    <h3 class="slider-label">Price Range (€):</h3>
                                    <div class="price_slider-container">
                                        <input type="range" id="priceSlider" name="price_slider" min="2000"
                                            max="50000" value="2000" step="500" class="price_slider">
                                        <span id="priceValue" class="slider-value">€ 2,000</span>
                                    </div>
                                    <!-- Slider for Squared Area -->
                                    <h3 class="slider-label">Squared Area (sqm):</h3>
                                    <div class="area_slider-container">
                                        <input type="range" id="areaSlider" name="area_slider" min="20"
                                            max="300" value="20" step="10" class="area_slider">
                                        <span id="areaValue" class="slider-value">20 sqm</span>
                                    </div>
                                </div>
                                <!-- Step 3 -->
                                <div class="form-step">
                                    <h3>Additional Information</h3>
                                    <div class="switch-container">
                                        <label class="switch-label" for="locationSwitch">Do you require a specific
                                            service?</label>
                                        <label class="switch">
                                            <input type="checkbox" id="locationSwitch">
                                            <span class="location_slider"></span>
                                        </label>
                                    </div>
                                    <input type="text" id="locationName" name="location_name"
                                        placeholder="Enter location name" class="input-field">
                                    <div id="googleMap" class="google-map"></div>
                                </div>

                                <!-- Step 4 -->
                                <div class="form-step">
                                    <h3>Step 4</h3>
                                    <input type="text" name="step4_field1" placeholder="Field 1" required>
                                    <input type="text" name="step4_field2" placeholder="Field 2" required>
                                </div>
                                <!-- Step 5 -->
                                <div class="form-step">
                                    <h3>Step 5</h3>
                                    <input type="text" name="step5_field1" placeholder="Field 1" required>
                                    <input type="text" name="step5_field2" placeholder="Field 2" required>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('multiStepForm');
            const steps = form.querySelectorAll('.form-step');
            const navItems = document.querySelectorAll('.step-navigation li');
            const nextButton = form.querySelector('.next');
            const prevButton = form.querySelector('.previous');
            const submitButton = form.querySelector('.submit');
            let currentStep = 0;


            let swap_type_id = null;


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

            navItems.forEach(item => {
                item.addEventListener('click', (e) => {
                    const step = parseInt(e.target.getAttribute('data-step'));
                    currentStep = step;
                    showStep(currentStep);
                });
            });

            nextButton.addEventListener('click', () => {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            });

            prevButton.addEventListener('click', () => {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            form.addEventListener('submit', (e) => {
                e.preventDefault();
                alert('Form submitted!');
                // Here you can add your form submission logic, e.g., using AJAX to submit the form data
            });

            showStep(currentStep);

            // Dropdown functionality
            const dropdownInput = document.getElementById('dropdownInput');
            const dropdownList = document.getElementById('dropdownList');
            const dropdownItems = dropdownList.querySelectorAll('li');
            const explanations = {
                1: "The most prevalent type of house exchange, allowing you to directly swap your property with someone else's.",
                2: "Suitable for those wishing to swap one property for two separate houses, often selected by couples going their separate ways and needing individual residences.",
                3: "Ideal for couples currently renting separate homes but seeking to combine their living arrangements into a single, larger residence."
            };
            dropdownInput.addEventListener('click', () => {
                dropdownList.style.display = dropdownList.style.display === 'block' ? 'none' : 'block';
            });

            dropdownItems.forEach(item => {
                item.addEventListener('click', (e) => {
                    const value = e.target.getAttribute('data-value');
                    dropdownInput.value = e.target.textContent;
                    dropdownList.style.display = 'none';
                    explanationText.textContent = explanations[value];
                    explanationText.style.display = 'block';
                    swap_type_id = value.replace('option', '');
                    updateStep2Content(value);
                });
            });

            const dropdownInput2 = document.getElementById('dropdownInput2');
            const dropdownList2 = document.getElementById('dropdownList2');
            const dropdownItems2 = dropdownList2.querySelectorAll('li');

            dropdownInput2.addEventListener('click', () => {
                dropdownList2.style.display = dropdownList2.style.display === 'block' ? 'none' : 'block';
            });

            dropdownItems2.forEach(item => {
                item.addEventListener('click', (e) => {
                    const value = e.target.getAttribute('data-value');
                    dropdownInput2.value = e.target.textContent;
                    dropdownList2.style.display = 'none';
                });
            });

            window.addEventListener('click', (e) => {
                if (!e.target.matches('#dropdownInput2')) {
                    dropdownList2.style.display = 'none';
                }
            });



            // Slider functionality for Number of Rooms
            const roomSlider = document.getElementById('roomSlider');
            const sliderValue = document.getElementById('sliderValue');

            roomSlider.addEventListener('input', (e) => {
                sliderValue.textContent = e.target.value;
            });

            // Slider functionality for Price Range
            const priceSlider = document.getElementById('priceSlider');
            const priceValue = document.getElementById('priceValue');

            priceSlider.addEventListener('input', (e) => {
                priceValue.textContent = `€ ${parseInt(e.target.value).toLocaleString()}`;
            });

            // Slider functionality for Squared Area
            const areaSlider = document.getElementById('areaSlider');
            const areaValue = document.getElementById('areaValue');

            areaSlider.addEventListener('input', (e) => {
                areaValue.textContent = `${e.target.value} sqm`;
            });

            // Initialize Google Map
            window.initMap = function() {
                const map = new google.maps.Map(document.getElementById('googleMap'), {
                    center: {
                        lat: -34.397,
                        lng: 150.644
                    },
                    zoom: 8
                });
            };

            // Switch functionality for Step 3
            const locationSwitch = document.getElementById('locationSwitch');
            const locationName = document.getElementById('locationName');

            // locationSwitch.addEventListener('change', () => {
            //     if (locationSwitch.checked) {
            //         locationName.style.display = 'block';
            //     } else {
            //         locationName.style.display = 'none';
            //     }
            // });

            // Initially hide the location name input
            // locationName.style.display = 'none';

        });
    </script>
@endsection
