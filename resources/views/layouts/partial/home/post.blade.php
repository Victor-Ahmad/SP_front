<div class="box box-dream hv-one card-content">
    <div class="image-group relative">
        <div class="swiper-container noo carousel-2 img-style">
            <div class="swiper-wrapper">
                @if (!empty($post['images']))
                    @foreach ($post['images'] as $image)
                        <div class="swiper-slide post_image_container">
                            <img class="post_image" src="{{ env('MEDIA_BASE_URL') . $image['image_path'] }}"
                                alt="images">
                        </div>
                    @endforeach
                @else
                    <div class="swiper-slide post_image_container">
                        <img class="post_image" src="assets/images/house/featured-7.jpg" alt="images">
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
        <h3 class="link-style-1"><a href="">{{ $post['location'] }}</a></h3>
        <div class="text-address">
            <p class="p-12">{{ $post['location'] }}</p>
        </div>
        <div class="money fs-18 fw-6 text-color-3"><a href="">€ {{ $post['price'] }}</a></div>
        <div class="icon-box flex">
            <div class="icons flex"><span>House Type: </span><span
                    class="fw-6">{{ $post['house_type']['type'] }}</span></div>
            <div class="icons flex"><span>Rooms: </span><span class="fw-6">{{ $post['number_of_rooms'] }}</span></div>
        </div>
        <div class="days-box flex justify-content-between align-items-center">
            <div class="chat-button-container ml-auto">
                <a href="#" class="btn btn-chat"><i class="fas fa-comments"></i> Chat</a>
            </div>
        </div>
    </div>
</div>
