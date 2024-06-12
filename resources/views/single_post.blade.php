@extends('layouts.master')

@section('title', $post['owner_name'])
@section('head_css')
    <link href="{{ asset('app/css/home.css') }}?v={{ filemtime(public_path('app/css/home.css')) }}" rel="stylesheet"
        type="text/css" media="all" />
    <style>
        #slider-wrap {
            position: relative;
            width: 100%;
            overflow: hidden;
            height: 50vh;
            display: flex;
            align-items: center;
        }

        #slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
            will-change: transform;
        }

        #slider img {
            height: 50vh;
            margin-right: 10px;
            /* Adjust gap between images */
            display: block;
        }

        .btns {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 10px;
            cursor: pointer;
            user-select: none;
            z-index: 1;
        }

        #previous {
            left: 0;
        }

        #next {
            right: 0;
        }

        @media (max-width: 768px) {
            #slider img {
                height: 30vh;
            }

            .btns {
                padding: 5px;
            }
        }

        .btn.btn-chat.center-text {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .btn.btn-chat.center-text i {
            margin-right: 5px;
            /* Adjust spacing between icon and text */
        }

        .image-group {
            position: relative;
        }

        .post_image_container {
            position: relative;
        }

        .blurred {
            filter: blur(20px);
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
            /* Space between the icon and text */
        }

        .overlay-text {
            font-size: 16px;
            color: #fff !important;
            /* Adjust the text size */
        }
    </style>
@endsection

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
                                            class=" @if ($index !== 0) blurred @endif">
                                        @if ($index !== 0 && !$post['showAll'])
                                            <div class="overlay-container">
                                                <i class="fas fa-lock overlay-icon"></i>
                                                <!-- Overlay icon for blurred images -->
                                                <p class="overlay-text">@lang('lang.complete profile first to view the images')</p> <!-- Overlay text -->
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <img src="assets/images/house/featured-7.png" alt="images"
                                        class=" @if (!$post['showAll']) blurred @endif">
                                    @if (!$post['showAll'])
                                        <div class="overlay-container">
                                            <i class="fas fa-lock overlay-icon"></i>
                                            <!-- Overlay icon for blurred images -->
                                            <p class="overlay-text">@lang('lang.complete profile first to view the images')</p> <!-- Overlay text -->
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div id="previous" class="btns">❮</div>
                            <div id="next" class="btns">❯</div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <div class="clearfix"></div>

        <section class="flat-property-detail property-detail2 style2">
            <br>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="post">
                            {{-- <div class="wrap-overview wrap-style">
                                <div class="titles">
                                    <h3>Overview</h3>
                                </div>
                                <div class="icon-wrap flex">
                                    <div class="box-icon">
                                        <div class="inner flex">
                                            <div class="content">
                                                <div class="font-2">@lang('lang.house type'):</div>
                                                <div class="font-2 fw-7">{{ __('lang.' . $post['house_type']['type']) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-icon">
                                        <div class="inner flex">
                                            <div class="content">
                                                <div class="font-2 ">@lang('lang.number of rooms'):</div>
                                                <div class="font-2 fw-7">{{ $post['number_of_rooms'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-icon">
                                        <div class="inner flex">
                                            <div class="content">
                                                <div class="font-2">@lang('lang.rent price'):</div>
                                                <div class="font-2 fw-7">{{ $post['price'] }} (€)</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
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
                                        <li class="flex"><span class="one fw-6">@lang('lang.house type'):</span><span
                                                class="two">{{ __('lang.' . $post['house_type']['type']) }}</span>
                                        </li>
                                        <li class="flex"><span class="one fw-6">@lang('lang.rooms'):</span><span
                                                class="two">{{ $post['number_of_rooms'] }}</span></li>
                                        <li class="flex"><span class="one fw-6">@lang('lang.rent price'):</span><span
                                                class="two">{{ $post['price'] }} (€)
                                            </span></li>
                                        <li class="flex"><span class="one fw-6">@lang('lang.area'):</span><span
                                                class="two">{{ $post['area'] }} (€)
                                            </span></li>
                                        <li class="flex"><span class="one fw-6">@lang('lang.description'):</span><span
                                                class="two">{{ $post['description'] }} (€)
                                            </span></li>

                                    </ul>
                                    {{-- <ul>
                                        <li class="flex"><span class="one fw-6">Beds</span><span
                                                class="two">7.328</span></li>
                                        <li class="flex"><span class="one fw-6">Year buit</span><span
                                                class="two">2022</span></li>
                                        <li class="flex"><span class="one fw-6">Type</span><span
                                                class="two">Villa</span></li>
                                        <li class="flex"><span class="one fw-6">Status</span><span class="two">For
                                                sale</span></li>
                                        <li class="flex"><span class="one fw-6">Garage</span><span class="two">1</span>
                                        </li>
                                    </ul> --}}
                                </div>
                            </div>
                            @if (!empty($post['intersts']))
                                <div class="wrap-overview wrap-style">
                                    <div class="titles">
                                        <h3>@lang('lang.interests')</h3>
                                    </div>
                                    <div class="icon-wrap flex">
                                        @foreach ($post['intersts'] as $interst)
                                            <div class="box-icon">
                                                <div class="inner flex">
                                                    <div class="content">
                                                        <div class="font-2 fw-7">{{ $interst['interest'] }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                            @endif
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
