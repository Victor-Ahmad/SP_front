@extends('layouts.master')

@section('title', 'OTP Verification')

@section('head_css')
    <style>
        .otp-input-container {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .otp-input {
            width: 50px;
            height: 60px;
            text-align: center !important;
            justify-content: center !important;
            font-size: 20px !important;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
            transition: border-color 0.3s ease;
            color: #6e55ff !important;
            /* Text color set to #6e55ff */
        }

        .otp-input:focus {
            border-color: #6e55ff;
            color: #6e55ff !important;
            box-shadow: 0 0 8px rgba(110, 85, 255, 0.3);
        }

        .main-w3layouts {
            display: flex;
            flex-direction: column;
            max-width: 500px;
            /* Adjusted width */
            margin: 50px auto;
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .main-agileinfo {
            padding: 40px;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .main-agileinfo h1 {
            color: #6e55ff;
            font-size: 2.5em;
            margin-bottom: 20px;
            text-align: center;
        }

        .agileits-top input[type="submit"] {
            width: 100%;
            padding: 15px;
            border: none;
            background: #6e55ff;
            color: white;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background 0.3s;
            margin: 10px 0;
        }

        .agileits-top input[type="submit"]:hover {
            background: #5a47e0;
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
            color: #6e55ff;
            text-decoration: none;
        }

        .additional-links a:hover {
            text-decoration: underline;
        }

        .parent_container {
            min-height: 85vh;
        }
    </style>
@endsection

@section('content')
    <div id="pagee" class="clearfix">
        <section class="slider flat-contact tf-section home5 relative">
            <div class="container parent_container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-w3layouts wrapper">
                            <div class="main-agileinfo">
                                <h1>Verify OTP</h1>
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
                                    <form action="{{ route('otp.verify') }}" method="post" id="otp-form">
                                        @csrf
                                        <div class="otp-input-container">
                                            <input type="text" name="otp[]" maxlength="1" class="otp-input" required>
                                            <input type="text" name="otp[]" maxlength="1" class="otp-input" required>
                                            <input type="text" name="otp[]" maxlength="1" class="otp-input" required>
                                            <input type="text" name="otp[]" maxlength="1" class="otp-input" required>
                                            <input type="text" name="otp[]" maxlength="1" class="otp-input" required>
                                            <input type="text" name="otp[]" maxlength="1" class="otp-input" required>
                                        </div>
                                        <input type="hidden" name="otp_code" id="otp_code">
                                        <input type="submit" value="VERIFY">
                                    </form>
                                    <div class="additional-links">
                                        <p>Didn't receive the OTP? <a href="#">Resend OTP</a></p>
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
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const inputs = document.querySelectorAll('.otp-input');

            inputs.forEach((input, index) => {
                input.addEventListener('input', (e) => {
                    if (e.target.value.length > 0) {
                        if (index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        }
                    }
                });

                input.addEventListener('keydown', (e) => {
                    if (e.key === "Backspace") {
                        if (input.value.length === 0 && index > 0) {
                            inputs[index - 1].focus();
                        }
                    }
                    if (e.key === "ArrowLeft" && index > 0) {
                        inputs[index - 1].focus();
                        setTimeout(() => inputs[index - 1].select(), 0);
                    } else if (e.key === "ArrowRight" && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                        setTimeout(() => inputs[index + 1].select(), 0);
                    }
                });

                input.addEventListener('focus', (e) => {
                    if (e.target.value.length > 0) {
                        e.target.select();
                    }
                });
            });

            const form = document.getElementById('otp-form');
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const otpCode = Array.from(inputs).map(input => input.value).join('');
                document.getElementById('otp_code').value = otpCode;
                form.submit();
            });
        });
    </script>
@endsection
