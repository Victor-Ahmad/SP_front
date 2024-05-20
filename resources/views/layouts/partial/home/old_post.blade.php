<div class="box box-dream hv-one">
    <div class="image-group relative ">
        <span class="featured fs-12 fw-6">Featured</span>
        <span class="featured style fs-12 fw-6">For sale</span>
        <span class="icon-bookmark"><i class="far fa-bookmark"></i></span>
        <div class="swiper-container noo carousel-2 img-style">
            <a href="property-detail-v1.html" class="icon-plus"><img src="assets/images/icon/plus.svg" alt="images"></a>
            <div class="swiper-wrapper ">
                @if (!empty($post['images']))
                    @foreach ($post['images'] as $image)
                        <div class="swiper-slide post_image_container"><img class="post_image"
                                src="{{ env('MEDIA_BASE_URL') . $image['image_path'] }}" alt="images">
                        </div>
                    @endforeach
                @else
                    <div class="swiper-slide post_image_container"><img class="post_image"
                            src="assets/images/house/featured-7.jpg" alt="images">
                    </div>
                @endif

            </div>
            <div class="pagi2">
                <div class="swiper-pagination2"> </div>
            </div>
            <div class="swiper-button-next2 "><i class="fal fa-arrow-right"></i>
            </div>
            <div class="swiper-button-prev2 "><i class="fal fa-arrow-left"></i>
            </div>
        </div>
    </div>
    <div class="content">
        <h3 class="link-style-1"><a href="">{{ $post['location'] }}</a> </h3>
        <div class="text-address">
            <p class="p-12">{{ $post['location'] }}</p>
        </div>
        <div class="money fs-18 fw-6 text-color-3"><a href="">€ {{ $post['price'] }}</a></div>
        <div class="icon-box flex">
            <div class="icons  flex"><span>House Type: </span><span class="fw-6">
                    {{ $post['house_type'] ?? $post['house_type_id'] }}</span>
            </div>
            <div class="icons  flex"><span>Rooms: </span><span class="fw-6"> {{ $post['number_of_rooms'] }}</span>
            </div>
            <div class="icons  flex"><span>Area: </span><span class="fw-6"> {{ $post['area'] }} sqm</span></div>
            <div class="icons  flex"><span>Sqft: </span><span class="fw-6">1150</span></div>
        </div>
        <div class="days-box flex justify-content-between align-items-center">
            <div class="chat-button-container ml-auto">
                <a href="#" class="btn btn-chat"><i class="fas fa-comments"></i> Chat</a>
            </div>
            <a class="compare flex align-center fw-6" href="#">Compare</a>
            <div class="img-author hv-tool" data-tooltip="Kathryn Murphy"><img src="assets/images/author/author-7.jpg"
                    alt="images"></div>
            <div class="days">{{ Carbon\Carbon::parse($post['updated_at'])->diffForHumans() }}</div>
        </div>
    </div>
</div>
