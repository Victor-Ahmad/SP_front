@extends('layouts.master')

@section('title', 'Home Page')

@section('content')
    <div id="pagee" class="clearfix">
        <!-- Main content of the home page goes here -->
        <!-- slider -->

        @include('layouts.partial.home.sliders')

        @include('layouts.partial.home.grid_posts')

        @include('layouts.partial.home.slide_posts_4')

        @include('layouts.partial.home.collection_posts')

        @include('layouts.partial.home.slide_posts_3')

        @include('layouts.partial.home.services')

        @include('layouts.partial.home.slide_posts_arrows')

        @include('layouts.partial.home.contact_us')

        @include('layouts.partial.home.reviews')

        @include('layouts.partial.home.slide_show')

        @include('layouts.partial.home.pricing')

        @include('layouts.partial.home.call')

    </div>
@endsection