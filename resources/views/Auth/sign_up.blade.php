@extends('layouts.master')

@section('title', 'Home Page')

@section('head_css')
    <style>
        .main-w3layouts {
            display: flex;
            flex-wrap: wrap;
            /* Ensure wrapping on small screens */
            max-width: 30vw;
            margin: 50px 0;
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .main-agileinfo {
            padding: 40px;
            /* width: 50%; */
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .main-agileinfo {
                width: 100%;
                /* Full width on small screens */
                padding: 20px;
            }
        }

        .main-agileinfo h1 {
            color: #ffa920;
            font-size: 2.5em;
            margin-bottom: 20px;
            text-align: center;
        }

        .agileits-top input[type="text"],
        .agileits-top input[type="email"],
        .agileits-top input[type="tel"] {
            width: calc(100% - 20px);
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #f3f3f3;
            font-size: 1em;
            color: black;
            /* Text color set to black */
        }

        .agileits-top input[type="text"]::placeholder,
        .agileits-top input[type="email"]::placeholder,
        .agileits-top input[type="tel"]::placeholder {
            color: #aaa;
            /* Placeholder text color */
        }

        .agileits-top input[type="text"]:focus,
        .agileits-top input[type="email"]:focus,
        .agileits-top input[type="tel"]:focus {
            border-color: #2981B2;
            box-shadow: 0 0 8px rgba(110, 85, 255, 0.3);
            /* Focus color set to #2981B2 */
            color: #2981B2;
            /* Text color on focus */
        }

        .wthree-text {
            margin: 20px 0;
        }

        .wthree-text label {
            display: flex;
            align-items: center;
        }

        .wthree-text input[type="checkbox"] {
            margin-right: 10px;
        }

        .wthree-text input[type="checkbox"]:checked+span::before {
            content: "\2713";
            display: inline-block;
            color: #ffa920;
            margin-right: 5px;
        }

        .wthree-text span {
            color: #2981B2;
        }

        .agileits-top input[type="submit"] {
            width: calc(100% - 20px);
            padding: 15px;
            border: none;
            background: #ffa920;
            color: white;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background 0.3s;
            margin: 10px 0;
        }

        .agileits-top input[type="submit"]:hover {
            background: #e6941c;
        }

        .alert {
            background-color: #f44336;
            color: white;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
        }

        .alert ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .alert .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
        }

        .alert .closebtn:hover {
            color: black;
        }

        .additional-links {
            text-align: center;
            margin-top: 20px;
        }

        .additional-links a {
            color: #ffa920;
            text-decoration: none;
        }

        .additional-links a:hover {
            text-decoration: underline;
        }

        .image-container {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fff;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .image-container {
                width: 100%;
                /* Full width on small screens */
                padding: 20px;
            }
        }

        .image-container img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 10px;
        }

        .parent_container {
            min-height: 85vh;
            padding: 10vh 0;
            margin-right: 25vw;
        }
    </style>
@endsection

@section('content')
    <div id="pagee" class="clearfix">
        <section class="slider home2 home5 signup ">
            <div class="container parent_container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-w3layouts wrapper ">
                            <div class="main-agileinfo">
                                <h1>@lang('lang.sign up')</h1>
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
                                    <form action="{{ route('register') }}" method="post">
                                        @csrf
                                        <input class="text" type="text" name="first_name"
                                            placeholder="@lang('lang.first name')" required>
                                        <input class="text email" type="text" name="last_name"
                                            placeholder="@lang('lang.last name')" required>
                                        <input class="text email" type="email" name="email"
                                            placeholder="@lang('lang.email')" required>
                                        <input class="text email" type="tel" name="phone_number"
                                            placeholder="@lang('lang.phone number')" required pattern="[0-9]{9,15}"
                                            title="Phone number must be between 10 to 15 digits">
                                        <div class="wthree-text">
                                            <label class="anim">
                                                <input type="checkbox" class="checkbox" required="">
                                                <span>@lang('lang.I agree to the terms & conditions')</span>
                                            </label>
                                        </div>
                                        <input type="submit" value="@lang('lang.sign up')">
                                    </form>
                                    <div class="additional-links">
                                        <p>@lang('lang.already have an account')? <a href="{{ route('login') }}">@lang('lang.login')</a></p>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="image-container">
                                <img src="path_to_your_image.jpg" alt="Registration Image">
                            </div> --}}
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
