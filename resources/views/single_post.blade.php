@extends('layouts.master')

@php
    $title = $post['location'] . ', ' . $post['street'] . ', ' . $post['post_code'];
    $dsc = 'Kamers: ' . $post['number_of_rooms'] . ', Oppervlakte: ' . explode('.', $post['area'])[0] . '(m²)';
    $og_image = !empty($post['images'])
        ? env('MEDIA_BASE_URL') . $post['images'][0]['image_path']
        : asset('assets/images/default_image.jpg');
@endphp

@section('title', $title)

@section('og_title', $title . ' - ' . $dsc)
@section('og_description', $dsc)
@section('og_image', $og_image)
@section('og_url', url()->current())

@section('head_css')
    <link href="{{ asset('app/css/home.css') }}?v={{ filemtime(public_path('app/css/home.css')) }}" rel="stylesheet"
        type="text/css" media="all" />
    <link href="{{ asset('app/css/home_ad.css') }}?v={{ filemtime(public_path('app/css/home_ad.css')) }}" rel="stylesheet"
        type="text/css" media="all" />
@endsection

@php
    $type = 0;
    $progress = $post['progress'];
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

@section('content')
    <div id="unique_page" class="clearfix background_color" style="padding: 10vh 0">
        <section class="unique_flat_slider style">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="slider-wrap">
                            <div id="slider">
                                @if (!empty($post['images']))
                                    @foreach ($post['images'] as $index => $image)
                                        <img src="{{ env('MEDIA_BASE_URL') . $image['image_path'] }}" alt="images"
                                            class=" @if (!$post['showAll']) blurred @endif">
                                        @if (!$post['showAll'])
                                            <div class="overlay-container">
                                                <i class="fas fa-lock overlay-icon"></i>
                                                <p class="overlay-text">@lang('lang.complete profile first to view the images')</p>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <img src="{{ asset('assets/images/house/featured-7.png') }}?v={{ filemtime(public_path('assets/images/house/featured-7.png')) }}"
                                        alt="images" class=" @if (!$post['showAll']) blurred @endif">
                                    @if (!$post['showAll'])
                                        <div class="overlay-container">
                                            <i class="fas fa-lock overlay-icon"></i>
                                            <p class="overlay-text">@lang('lang.complete profile first to view the images')</p>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="clearfix"></div>

        <section class="flat-property-detail property-detail2 style2">
            <br>
            <div class="container">
                @if ($post['progress']['progress'] != '100 %')
                    <div class="progress-container">
                        <div class="progress-circle">
                            <svg viewBox="0 0 100 100">
                                <circle class="background" cx="50" cy="50" r="45"></circle>
                                <circle class="foreground" cx="50" cy="50" r="45"></circle>
                            </svg>
                            <div class="progress-text" id="progress-text"></div>
                        </div>
                        <div class="missing-steps">
                            <P>@lang('lang.complete_your_account_to_get_better_house_exchange_matches')</P>
                            <a href="{{ route('profile.compelete.get', ['type' => $type]) }}">@lang('lang.go_profile')</a>
                        </div>
                    </div>
                    <br>
                    <hr>
                @endif
                <div class="row">
                    <div class="col-lg-8">
                        <div class="post">
                            <div class="wrap-overview wrap-style">
                                <div class="titles">
                                    <h3>@lang('lang.location')</h3>
                                </div>
                                <div class="icon-wrap flex">
                                    <div class="box-icon">
                                        <div class="inner flex">
                                            <div class="content">
                                                <div class="font-2 ">@lang('lang.location'):</div>
                                                <div class="font-2 fw-7">{{ $post['location'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-icon">
                                        <div class="inner flex">
                                            <div class="content">
                                                <div class="font-2">@lang('lang.post code'):</div>
                                                <div class="font-2 fw-7">{{ $post['post_code'] }} </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-icon">
                                        <div class="inner flex">
                                            <div class="content">
                                                <div class="font-2">@lang('lang.street'):</div>
                                                <div class="font-2 fw-7">{{ $post['street'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wrap-property wrap-style">
                                <div class="titles">
                                    <h3>@lang('lang.house_details')</h3>
                                </div>
                                <div class="box flex">
                                    <ul>
                                        <li class="flex"><span class="one fw-6 special_span">@lang('lang.house type'):</span>
                                            @if (isset($post['house_type']) && isset($post['house_type']['type']))
                                                <span class="two">{{ __('lang.' . $post['house_type']['type']) }}</span>
                                            @endif
                                        </li>
                                        <li class="flex"><span class="one fw-6 special_span">@lang('lang.rooms'):</span>
                                            @if (isset($post['number_of_rooms']) && $post['number_of_rooms'] !== '')
                                                <span class="two">{{ $post['number_of_rooms'] }}</span>
                                            @endif
                                        </li>
                                        <li class="flex"><span class="one fw-6 special_span">@lang('lang.rent price'):</span>
                                            @if (isset($post['price']) && $post['price'] !== '')
                                                <span class="two">{{ $post['price'] }} (€)</span>
                                            @endif
                                        </li>
                                        <li class="flex"><span class="one fw-6 special_span">@lang('lang.area'):</span>
                                            @if (isset($post['area']) && $post['area'] !== '')
                                                <span class="two">{{ $post['area'] }} (m²)</span>
                                            @endif
                                        </li>
                                        <li class="flex"><span class="one fw-6 special_span">@lang('lang.house_description'):</span>
                                            @if (isset($post['description']) && $post['description'] !== '')
                                                <span class="two">{{ $post['description'] }}</span>
                                            @endif
                                        </li>
                                    </ul>

                                </div>
                            </div>
                            <div class="wrap-overview wrap-style">
                                <div class="titles">
                                    <h3>@lang('lang.interests')</h3>
                                </div>
                                <div class="icon-wrap flex">
                                    @if (!empty($post['intersts']) && isset($post['intersts'][0]['wish_locations']))
                                        @foreach ($post['intersts'][0]['wish_locations'] as $interst)
                                            <div class="box-icon">
                                                <div class="inner flex">
                                                    <div class="content">
                                                        <div class="font-2 fw-7">{{ $interst['location'] }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="chat-button-container ">
                                <a href="{{ route('checkChat', ['userId' => $post['user_id']]) }}"
                                    class="btn btn-chat center-text"><i class="fas fa-comments"></i> @lang('lang.chat') -
                                    {{ $post['owner_name'] }}</a>
                            </div>
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
            const progressValue = {{ json_encode((int) str_replace(' %', '', $post['progress']['progress'])) }};
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
        document.addEventListener('DOMContentLoaded', (event) => {
            let pos = 0;
            const slider = document.getElementById('slider');
            const sliderImages = slider.querySelectorAll('img');
            const totalImages = sliderImages.length;

            function getImageWidths() {
                return Array.from(sliderImages).map(img => {
                    const style = window.getComputedStyle(img);
                    const marginRight = parseInt(style.marginRight);
                    return img.clientWidth + marginRight;
                });
            }

            let imageWidths = getImageWidths();
            let totalWidth = imageWidths.reduce((acc, width) => acc + width, 0);
            slider.style.width = `${totalWidth}px`;

            function moveSlider() {
                const offset = imageWidths.slice(0, pos).reduce((acc, width) => acc + width, 0);
                slider.style.transform = `translateX(-${offset}px)`;
            }

            function updateWidths() {
                imageWidths = getImageWidths();
                totalWidth = imageWidths.reduce((acc, width) => acc + width, 0);
                slider.style.width = `${totalWidth}px`;
                moveSlider();
            }

            document.getElementById('next').addEventListener('click', () => {
                if (pos < totalImages - 1) {
                    pos++;
                } else {
                    pos = 0;
                }
                moveSlider();
            });

            document.getElementById('previous').addEventListener('click', () => {
                if (pos > 0) {
                    pos--;
                } else {
                    pos = totalImages - 1;
                }
                moveSlider();
            });

            // Handle window resize
            window.addEventListener('resize', updateWidths);

            // Touch swipe support for mobile devices
            let startX = 0;
            let endX = 0;

            slider.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
            });

            slider.addEventListener('touchmove', (e) => {
                endX = e.touches[0].clientX;
            });

            slider.addEventListener('touchend', () => {
                if (startX - endX > 50) {
                    pos = (pos + 1) % totalImages;
                } else if (endX - startX > 50) {
                    pos = (pos - 1 + totalImages) % totalImages;
                }
                moveSlider();
            });
        });
    </script>
@endsection
