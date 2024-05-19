<section class="slider flat-featured wg-dream home5">
    <div class="container3">
        <div class="row">
            <div class="col-lg-12 form-sl background_white">
                <div class="heading-section center">
                    <h2 class="heading_title">Available Offers</h2>
                </div>
                <div class="flat-tabs themesflat-tabs">
                    <div class="content-tab">
                        <div class="content-inner tab-content">
                            <div class="wrap-item flex">
                                @foreach ($posts as $post)
                                    @include('layouts.partial.home.post', ['post' => $post])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
