@extends('layouts.master')

@section('title', 'Home Page')
@section('head_css')
    <link href="{{ asset('app/css/home.css') }}?v={{ filemtime(public_path('app/css/home.css')) }}" rel="stylesheet"
        type="text/css" media="all" />
    <style>
        .filter-toggle-btn {
            display: none;
            background-color: #ffa920;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background 0.3s;
            margin-bottom: 10px;
            width: 25%;
            text-align: center;
        }

        .filter-toggle-btn:hover {
            background-color: #e6941c;
        }

        @media (max-width: 768px) {
            .filter-form-container {
                display: none;
            }

            .filter-toggle-btn {
                display: block;
                margin: 10px 0;
            }
        }

        @media (min-width: 769px) {
            .filter-toggle-btn {
                display: none;
            }

            .filter-form-container {
                display: flex;
            }
        }

        .image-group {
            position: relative;
        }

        .post_image_container {
            position: relative;
        }

        .blurred {
            filter: blur(10px);
            /* Adjust the blur intensity */
            width: 100%;
            /* Adjust the size as needed */
        }

        .overlay-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
        }

        .overlay-icon {
            font-size: 50px;
            /* Adjust the icon size */
            margin-bottom: 10px;
            color: #2a81b2 !important;
            /* Space between the icon and text */
        }

        .overlay-text {
            font-size: 16px;
            color: #2a81b2 !important;
            /* Adjust the text size */
        }





        .progress-container {
            display: flex;
            align-items: center;
            justify-content: flex-start;

        }

        .progress-circle {
            position: relative;
            width: 150px;
            height: 150px;
        }

        .progress-circle svg {
            width: 100%;
            height: 100%;
            transform: rotate(-90deg);
        }

        .progress-circle circle {
            fill: none;
            stroke-width: 10;
        }

        .progress-circle .background {
            stroke: #ffa920;
        }

        .progress-circle .foreground {
            stroke: #2a81b2;
            stroke-linecap: round;
            stroke-dasharray: 0 100;
            transition: stroke-dasharray 1s ease, stroke-dashoffset 1s ease;
            transition-delay: 0.3s;
        }

        .progress-circle .progress-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 1.5em;
            font-weight: bold;
        }

        .missing-steps {
            margin-left: 20px;
        }

        .missing-steps p {
            font-size: 1em;
        }

        .missing-steps a {
            display: block;
            color: #2a81b2 !important;
            text-decoration: none;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 1em;
        }

        .missing-steps a:hover {
            text-decoration: none !important;
            color: #ff9700 !important;

        }

        .missing-steps a:hover {
            text-decoration: underline;
        }
    </style>
@endsection

@section('content')


    <div id="pagee" class="clearfix">
        @include('layouts.partial.home.grid_posts', ['posts' => $posts])
    </div>
@endsection



@section('additional_scripts')
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqpFnYM5ToiPcFtSC2SFMo55w3xNgViSQ&libraries=places&callback=initAutocomplete&language=nl">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const progressValue = {{ json_encode((int) str_replace(' %', '', $progress['progress'])) }};
            const circumference = 2 * Math.PI * 45;
            const offset = circumference - (progressValue / 100) * circumference;
            const foregroundCircle = document.querySelector('.progress-circle .foreground');
            const progressText = document.getElementById('progress-text');

            foregroundCircle.style.strokeDasharray = `${circumference} ${circumference}`;
            foregroundCircle.style.strokeDashoffset = offset;
            progressText.textContent = `${progressValue}%`;
        });
    </script>
    <script>
        function toggleFilter() {
            const filterForm = document.querySelector('.filter-form-container');
            filterForm.style.display = filterForm.style.display === 'flex' ? 'none' : 'flex';
        }

        function clearFilters() {
            document.querySelector('#searchAutocompleteInput').value = '';
            document.querySelector('input[name="rooms"]').value = 'any';
            document.querySelector('input[name="min_value"]').value = '';
            document.querySelector('input[name="max_value"]').value = '';
        }
    </script>
    <script>
        let currentSlideIndex = 0;

        function openGallery(imagesJson) {
            const images = JSON.parse(imagesJson);
            const modal = document.getElementById('galleryModal');
            const modalContent = document.querySelector('.modal-slide');
            modalContent.innerHTML = '';

            if (images.length === 0) {
                // modalContent.innerHTML = '<img class="modal-image" src="assets/images/house/featured-7.jpg" alt="images">';
            } else {
                images.forEach((image, index) => {
                    const img = document.createElement('img');
                    img.src = `{{ env('MEDIA_BASE_URL') }}${image.image_path}`;
                    img.classList.add('modal-image');
                    if (index !== 0) img.style.display = 'none';
                    modalContent.appendChild(img);
                });
                modal.style.display = 'block';
                currentSlideIndex = 0;
            }


        }

        function closeGallery() {
            document.getElementById('galleryModal').style.display = 'none';
        }

        function changeSlide(n) {
            const slides = document.querySelectorAll('.modal-image');
            slides[currentSlideIndex].style.display = 'none';
            currentSlideIndex = (currentSlideIndex + n + slides.length) % slides.length;
            slides[currentSlideIndex].style.display = 'block';
        }

        document.addEventListener('click', function(event) {
            const modal = document.getElementById('galleryModal');
            if (event.target === modal) {
                closeGallery();
            }
        });
    </script>
    <script>
        function initAutocomplete() {
            var input = document.getElementById('searchAutocompleteInput');


            var autocomplete = new google.maps.places.Autocomplete(input, {
                types: ['(cities)'],
                componentRestrictions: {
                    country: "NL"
                }
            });

            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                console.log(place);

                if (!place.place_id) {
                    alert("Please select a place from the dropdown list.");
                    return;
                }
                input.value = place.name;
            });



        }

        $(document).ready(function() {
            $('.nice-select').on('click', '.option', function() {
                var value = $(this).data('value');
                $(this).closest('.nice-select').find('input[type="hidden"]').val(value);
            });
        });

        $(document).ready(function() {
            $('.noUi-handle').on('click', function() {
                $(this).width(50);
            });
            var minValue = parseInt('{{ request('min_value', 100) }}', 10);
            var maxValue = parseInt('{{ request('max_value', 2000) }}', 10);
            var rangeSlider = document.getElementById('slider-range');
            var moneyFormat = wNumb({
                decimals: 0,
                thousand: ',',
                prefix: '€'
            });
            noUiSlider.create(rangeSlider, {
                start: [minValue, maxValue],
                step: 1,
                range: {
                    'min': [100],
                    'max': [2000]
                },
                format: moneyFormat,
                connect: true
            });
            // Set visual min and max values and also update value hidden form inputs
            rangeSlider.noUiSlider.on('update', function(values, handle) {
                document.getElementById('slider-range-value1').innerHTML = values[0];
                document.getElementById('slider-range-value2').innerHTML = values[1];
                document.getElementById('min_value').value = moneyFormat.from(values[0]);
                document.getElementById('max_value').value = moneyFormat.from(values[1]);
            });
        });

        function clearFilters() {
            window.location.href = "{{ route('home') }}";
        }
    </script>
@endsection
