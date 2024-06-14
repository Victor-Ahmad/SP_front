@extends('layouts.master')

@section('title', 'Registration')

@section('head_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
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


        .required-field::before {
            content: '*';
            color: red;
            margin-right: 5px;
        }




        .center-content {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: 100%;
        }




        .preview-slideshow img {
            position: relative;
            margin-right: 10px;
        }

        .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            background: red;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            font-size: 12px;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }



        /* Extra Small Devices (phones, 600px and down) */
        @media (max-width: 600px) {
            .container.parent_container {
                padding: 0 10px;
            }

            .wrap-contact {
                padding: 15px 5px;
            }

            .form-group {
                width: 100%;
            }

            .input-field,

            textarea {
                width: 100%;
            }


            .form-row {
                flex-direction: column;
            }

            .preview-slideshow img {
                width: 100%;
                margin-right: 0;
            }

            .preview-container {
                flex-direction: column;
                align-items: center;
            }
        }

        /* Small Devices (portrait tablets and large phones, 600px to 768px) */
        @media (max-width: 768px) {
            .container.parent_container {
                padding: 0 15px;
            }

            .wrap-contact {
                padding: 20px 10px;
            }

            .stepper-wrapper {
                flex-direction: row;
                justify-content: space-between;
            }

            .stepper-item {
                flex-direction: row;
                align-items: center;
                justify-content: center;
                margin-bottom: 10px;
            }

            .step-counter {
                padding: 10px 15px;
                font-size: 14px;
            }



            .form-group {
                width: 100%;
            }

            .input-field,

            textarea {
                width: 100%;
            }



            .form-row {
                flex-direction: column;
            }
        }

        /* Medium Devices (landscape tablets, 768px to 992px) */
        @media (max-width: 992px) {
            .stepper-wrapper {
                flex-direction: row;
                justify-content: space-between;
            }

            .stepper-item {
                flex-direction: row;
                align-items: center;
                justify-content: center;
                margin-bottom: 10px;
            }

            .step-counter {
                padding: 10px 15px;
                font-size: 16px;
            }



            .form-group {
                width: 100%;
            }

            .input-field,

            textarea {
                width: 100%;
            }


        }

        /* Large Devices (laptops/desktops, 992px to 1200px) */
        @media (max-width: 1200px) {
            .step-counter {
                padding: 10px 20px;
                font-size: 16px;
            }



            .form-group {
                width: 100%;
            }

            .input-field,

            textarea {
                width: 100%;
            }


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

                            <hr>

                            <form id="multiStepForm" action="{{ route('profile.compelete.post') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf


                                <div class="row center-content">
                                    <h3 style="font-size: 24px !important;">@lang('lang.more_into_your_house')</h3>
                                </div>
                                <hr>
                                <br>
                                <div class="form-row">
                                    <div class="form-group">
                                        <h3 class="description-label label">@lang('lang.house_description')</h3>
                                        <textarea id="house_description" name="house_description" placeholder="@lang('lang.describe your house')" class="input-field required"
                                            rows="4" style="resize: none;">{{ old('house_description') }}</textarea>
                                    </div>
                                </div>
                                <div style="margin-top:30px"></div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <h3>@lang('lang.house gallery')</h3>
                                        <p style="margin-top:15px">@lang('lang.add_house_picture')</p>
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
                                </div>
                                <div style="margin-top:30px "></div>

                                <!-- Navigation Buttons -->
                                <div class="form-navigation">

                                    <button type="submit" class="submit">@lang('lang.submit')</button>
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
        const prevSlideButton = document.getElementById('prevSlide');
        const nextSlideButton = document.getElementById('nextSlide');
        const galleryInput = document.getElementById('gallery');
        let currentSlide = 0;
        let images = [];
        let filesArray = [];

        // Handle gallery upload and preview
        galleryInput.addEventListener('change', function(event) {
            const files = Array.from(event.target.files);
            images = [];
            filesArray = files;
            files.forEach(file => {
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
            visibleImages.forEach((src, index) => {
                const imgContainer = document.createElement('div');
                imgContainer.style.position = 'relative';
                const img = document.createElement('img');
                img.src = src;
                imgContainer.appendChild(img);

                const removeBtn = document.createElement('button');
                removeBtn.innerHTML = '&times;';
                removeBtn.className = 'remove-image';
                removeBtn.addEventListener('click', () => {
                    const actualIndex = currentSlide + index;
                    images.splice(actualIndex, 1);
                    filesArray.splice(actualIndex, 1);
                    updateFileInput();
                    if (currentSlide >= images.length - 5 && currentSlide > 0) {
                        currentSlide--;
                    }
                    updateSlideshow();
                });
                imgContainer.appendChild(removeBtn);
                slideshow.appendChild(imgContainer);
            });

            prevSlideButton.disabled = currentSlide === 0;
            nextSlideButton.disabled = currentSlide >= images.length - 5;
        }

        function updateFileInput() {
            const dataTransfer = new DataTransfer();
            filesArray.forEach(file => dataTransfer.items.add(file));
            galleryInput.files = dataTransfer.files;
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
