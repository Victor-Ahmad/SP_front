@extends('layouts.master')

@section('title', 'Woningruil')

@section('head_css')
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
            background-color: #18638b !important;
            /* Hover background color */
        }

        .btn-signup-container {
            width: 100%;
        }

        .custom_h1 {
            padding: 0 !important;
        }

        /* .custom_heading {
                                            padding: 0 5vw !important;
                                        } */
    </style>
@endsection

@section('content')
    <div id="pagee" class="clearfix">
        <!-- Main content of the home page goes here -->
        <!-- slider -->

        @include('layouts.partial.landing.sliders')

        @include('layouts.partial.landing.services')

        @include('layouts.partial.home.contact_us')

        {{-- @include('layouts.partial.home.reviews') --}}

        {{-- @include('layouts.partial.home.slide_show') --}}

    </div>
@endsection