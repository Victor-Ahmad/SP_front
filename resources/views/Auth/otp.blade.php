<!DOCTYPE html>
<html>

<head>
    <title>OTP Verification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Custom Theme files -->

    <link href="{{ asset('app/css/auth.register.css') }}?v={{ filemtime(public_path('app/css/auth.register.css')) }}"
        rel="stylesheet" type="text/css" media="all" />
    <!-- //Custom Theme files -->
    <!-- web font -->
    <link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
    <!-- //web font -->
</head>

<body>
    <!-- main -->
    <div class="main-w3layouts wrapper">
        <h1>OTP Verification</h1>
        <div class="main-agileinfo">
            <div class="agileits-top">
                <!-- Display Error Messages -->
                @if ($errors->any())
                    <div class="alert">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
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
            </div>
        </div>
        <!-- copyright -->
        <div class="colorlibcopy-agile">
            <p>© 2024 Woningruil Signup Form. All rights reserved | Design by <a href=""
                    target="_blank">Woningruil</a></p>
        </div>
        <!-- //copyright -->
        <ul class="colorlib-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <!-- //main -->
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
</body>

</html>
