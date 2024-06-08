@extends('layouts.master')

@section('title', 'Home Page')

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
        }

        .stepper-item::before,
        .stepper-item::after {
            content: '';
            position: absolute;
            top: 46%;
            transform: translateY(-50%);
            border-top: 6px solid #ccc;
            width: 100%;
            height: 0;
            z-index: 2;
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

        .stepper-item .step-counter {
            position: relative;
            z-index: 5;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #ccc;
            margin-bottom: 6px;
            transition: background-color 0.3s ease;
            /* Add transition for background color */
        }

        .stepper-item.active .step-counter,
        .stepper-item.completed .step-counter {
            background-color: #ffa920;
            color: white;
            font-weight: bold;
            font-size: 18px !important;
            border: 2px solid #2981B2;
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
                            <div class="stepper-wrapper">
                                <div class="stepper-item completed">
                                    <div class="step-counter">1</div>
                                </div>
                                <div class="stepper-item active progress-bar-half">
                                    <div class="step-counter">2</div>
                                </div>
                                <div class="stepper-item">
                                    <div class="step-counter">3</div>
                                </div>
                                <div class="stepper-item">
                                    <div class="step-counter">4</div>
                                </div>
                            </div>
                            <form id="multiStepForm" action="{{ route('complete_account') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <!-- Step 1 -->
                                <div class="form-step form-step-active"></div>
                                <!-- Step 2 -->
                                <div class="form-step"></div>
                                <!-- Step 3 -->
                                <div class="form-step"></div>
                                <!-- Step 4 -->
                                <div class="form-step"></div>
                                <!-- Navigation Buttons -->
                                <div class="form-navigation">
                                    <button type="button" class="previous" disabled>@lang('lang.previous')</button>
                                    <button type="button" class="next">@lang('lang.next')</button>
                                    <button type="submit" class="submit" style="display: none;">@lang('lang.submit')</button>
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
                if (currentStep < steps.length - 1) {
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
        });
    </script>
@endsection
