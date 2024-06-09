<section class="flat-featured wg-dream home5">
    <div class="container3">
        <div class="row">
            <div class="col-lg-12 background_white">
                <div class="flat-tabs themesflat-tabs">
                    <div class="content-tab">
                        <div class="content-inner tab-content">
                            <div class="wrap-item flex">
                                @foreach ($posts as $post)
                                    <a href="{{ route('register') }}" class="card-link">
                                        @include('layouts.partial.landing.post', ['post' => $post])
                                    </a>
                                @endforeach
                            </div>
                            @if (empty($posts))
                                <div class="row justify-content-center align-items-center" style="min-height: 50vh;">
                                    <div class="col-12">
                                        <div class="no-results">
                                            @lang('lang.no matches found for your search criteria')
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="galleryModal" class="modal">
    <span class="close" onclick="closeGallery()">&times;</span>
    <div class="modal-content">
        <div class="modal-slide">
            <!-- Images will be dynamically added here -->
        </div>
        <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
        <a class="next" onclick="changeSlide(1)">&#10095;</a>
    </div>
</div>
