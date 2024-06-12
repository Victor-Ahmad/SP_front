<div class="box box-dream hv-one card-content">
    <div class="image-group relative">
        <div class="swiper-container noo carousel-2 img-style">
            <div class="swiper-wrapper">
                @if (!empty($post['images']))
                    @foreach ($post['images'] as $index => $image)
                        <div class="swiper-slide post_image_container">
                            <img class="post_image @if ($index !== 0) blurred @endif"
                                src="{{ env('MEDIA_BASE_URL') . $image['image_path'] }}" alt="images">
                            @if ($index !== 0)
                                <div class="overlay-container">
                                    <i class="fas fa-lock overlay-icon"></i> <!-- Overlay icon for blurred images -->
                                    <p class="overlay-text">@lang('lang.log in to view images')</p> <!-- Overlay text -->
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
        <div class="text-address">
            <p class="p-12">{{ $post['post_code'] }} </p>
        </div>
        <div class="money fs-18 fw-6 text-color-3"><a href="">€ {{ $post['price'] }}</a></div>
        <div class=" "><span>@lang('lang.house type'): </span><span
                class="fw-6">{{ __('lang.' . $post['house_type']['type']) }}</span></div>

        <div class="flex">
            <div class=""><span>@lang('lang.rooms'): </span><span
                    class="fw-6">{{ $post['number_of_rooms'] }}</span></div>
        </div>

    </div>
</div>
