<!DOCTYPE html>
<html>

<head>
    <title>Set Password</title>
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
        <h1>Set Password</h1>
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

                <form action="{{ route('password.set') }}" method="post" id="password-form">
                    @csrf
                    <input class="text" type="password" name="password" placeholder="Password" required>
                    <input class="text email" type="password" name="password_confirmation"
                        placeholder="Confirm Password" required>
                    <input type="submit" value="SET PASSWORD">
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
</body>

</html>
