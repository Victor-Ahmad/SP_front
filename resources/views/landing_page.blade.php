@extends('layouts.master')

@section('title', 'Woningruil')

@section('head_css')
    <link href="{{ asset('app/css/home.css') }}?v={{ filemtime(public_path('app/css/home.css')) }}" rel="stylesheet"
        type="text/css" media="all" />
    <style>
        .d-flex {
            display: flex;
        }

        .justify-content-center {
            justify-content: center;
        }

        .btn-signup {
            width: 100%;
            background-color: #2981B2 !important;
            /* Default background color */
            color: #fff !important;
            /* Default text color */
            transition: background-color 0.3s ease !important;
        }

        .btn-signup:hover {
            /* background-color: #ffa920 !important; */
            /* color: #ffa920 !important; */
            transition: background-color 0.3s ease !important;
            background-color: #2a81b2 !important;
            /* Hover background color */
        }

        .btn-signup-container {
            width: 100%;
        }

        .custom_h1 {
            padding: 0 !important;
        }

        .text-outline {
            color: #2a81b2;
            /* You can set the text color as desired */

            /* Blue outline */

            /* Adjust as necessary */
        }

        .image-group {
            position: relative;
        }

        .post_image_container {
            position: relative;
        }

        .blurred {
            filter: blur(10px);
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

        .flat-icon {
            background-color: #fff !important;
        }
    </style>
@endsection

@section('content')
    <div id="pagee" class="clearfix">
        <!-- Main content of the home page goes here -->
        <!-- slider -->

        @include('layouts.partial.landing.sliders')

        @include('layouts.partial.landing.services')

        @include('layouts.partial.landing.grid_posts', ['posts' => $posts])

        @include('layouts.partial.landing.contact_us')

        {{-- @include('layouts.partial.home.reviews') --}}

        {{-- @include('layouts.partial.home.slide_show') --}}

    </div>
@endsection
