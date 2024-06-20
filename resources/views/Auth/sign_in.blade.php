@extends('layouts.master')

@section('title', 'Sign In')

@section('head_css')
    <link href="{{ asset('app/css/home.css') }}?v={{ filemtime(public_path('app/css/home.css')) }}" rel="stylesheet"
        type="text/css" media="all" />
    <link href="{{ asset('app/css/login.css') }}?v={{ filemtime(public_path('app/css/login.css')) }}" rel="stylesheet"
        type="text/css" media="all" />
@endsection

@section('content')
    <div id="pagee" class="clearfix">
        <section class="slider home2 home5  signup ">
            <div class="container parent_container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-w3layouts wrapper">
                            <div class="main-agileinfo">
                                <h1>@lang('lang.sign in')</h1>
                                <div class="agileits-top">
                                    <!-- Display Error Messages -->
                                    @if ($errors->any())
                                        <div class="alert">
                                            <span class="closebtn"
                                                onclick="this.parentElement.style.display='none';">&times;</span>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('login') }}" method="post">
                                        @csrf
                                        <input class="text email" type="tel" name="phone_number"
                                            placeholder="@lang('lang.phone number')" required pattern="[0-9]{9,15}"
                                            title="Phone number must be between 10 to 15 digits">
                                        <input class="text" type="password" name="password"
                                            placeholder="@lang('lang.password')" required>
                                        <input type="submit" value="@lang('lang.sign in')">
                                    </form>
                                    <div class="additional-links">
                                        <p> @lang('lang.dont have an account')? <a href="{{ route('register') }}">@lang('lang.sign up')</a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('additional_scripts')
    <script></script>
@endsection
