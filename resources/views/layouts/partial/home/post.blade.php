<div class="box box-dream hv-one card-content">
    <div class="image-group relative">
        <div class="swiper-container noo carousel-2 img-style">
            <div class="swiper-wrapper">
                @if (!empty($post['images']))
                    @foreach ($post['images'] as $index => $image)
                        <div class="swiper-slide post_image_container">
                            <img class="post_image @if ($index !== 0) blurred @endif"
                                src="{{ env('MEDIA_BASE_URL') . $image['image_path'] }}" alt="images">
                            @if ($index !== 0 && !$showAll)
                                <div class="overlay-container">
                                    <i class="fas fa-lock overlay-icon"></i> <!-- Overlay icon for blurred images -->
                                    <p class="overlay-text">@lang('lang.complete_profile_first_to_view_the_images')</p> <!-- Overlay text -->
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="swiper-slide post_image_container"
                        style=" display: flex;
                    justify-content: center;
                    align-items: center;">
                        <img class="post_image"
                            style="  max-width: 100%;
                            max-height: 100%;
                        height: auto;   
                        object-fit: contain; "
                            src="assets/images/house/featured-7.png" alt="images">
                    </div>
                @endif
            </div>
            <div class="pagi2">
                <div class="swiper-pagination2"></div>
            </div>
            <div class="swiper-button-next2"><i class="fal fa-arrow-right"></i></div>
            <div class="swiper-button-prev2"><i class="fal fa-arrow-left"></i></div>
        </div>
    </div>
    <div class="content">
        <h3 class="link-style-1"><a href="">{{ $post['location'] }}, {{ $post['street'] }}</a></h3>
        <p class="p-12">{{ $post['post_code'] }}</p>
        <div class="text-address">

            <p class="p-12">{{ $post['user']['first_name'] }} {{ $post['user']['last_name'] }}</p>
        </div>
        <div class="money fs-18 fw-6 text-color-3"><a href="">€ {{ $post['price'] }}</a></div>
        <div class=" "><span>@lang('lang.house type'): </span><span
                class="fw-6">{{ __('lang.' . $post['house_type']['type']) }}</span></div>

        <div class="flex">
            <div class=""><span>@lang('lang.rooms'): </span><span
                    class="fw-6">{{ $post['number_of_rooms'] }}</span></div>
        </div>
        <div class="icon-box flex">
            <div class=""><span>@lang('lang.interests'): </span><span class="fw-6">
                    @if (isset($post['user']['intersts']) && !empty($post['user']['intersts']))
                        @foreach ($post['user']['intersts'] as $interest)
                            {{ $interest['interest'] }},
                        @endforeach
                    @endif
                </span>
            </div>
        </div>

        <div class="days-box flex justify-content-between align-items-center">
            <div class="chat-button-container ml-auto">
                <a href="{{ route('checkChat', ['userId' => $post['user']['id']]) }}" class="btn btn-chat"><i
                        class="fas fa-comments"></i> @lang('lang.chat')</a>
            </div>
        </div>
    </div>
</div>
