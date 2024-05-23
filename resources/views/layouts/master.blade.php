<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Default Title')</title>
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet"
        href="{{ asset('app/dist/font-awesome.css') }}?v={{ filemtime(public_path('app/dist/font-awesome.css')) }}">
    <link rel="stylesheet" href="{{ asset('app/dist/app.css') }}?v={{ filemtime(public_path('app/dist/app.css')) }}">
    <link rel="stylesheet"
        href="{{ asset('app/dist/responsive.css') }}?v={{ filemtime(public_path('app/dist/responsive.css')) }}">
    <link rel="stylesheet" href="{{ asset('app/dist/owl.css') }}?v={{ filemtime(public_path('app/dist/owl.css')) }}">
    <link rel="shortcut icon"
        href="{{ asset('assets/images/logo/Favicon.png') }}?v={{ filemtime(public_path('assets/images/logo/Favicon.png')) }}">
    <link rel="apple-touch-icon-precomposed"
        href="{{ asset('assets/images/logo/Favicon.png') }}?v={{ filemtime(public_path('assets/images/logo/Favicon.png')) }}">
    <style>
        .navigation li a:hover {
            color: #2a81b2 !important;
        }

        .widget-logo-footer {
            padding: 10px 0;
        }


        .language-switcher {
            position: relative;
            display: inline-block;
        }

        .menu-btn {
            background-color: #2a81b2;
            color: white;
            padding: 5px 10px;
            font-size: 14px;
            border: none;
            cursor: pointer;
            border-radius: 3px;
            text-transform: uppercase;
            margin: 0 15px;
        }

        .menu-btn:hover,
        .menu-btn:focus {
            background-color: #1e6392;
        }

        .language-menu {
            position: relative;
            display: inline-block;
        }

        .menu-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 60px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
        }

        .menu-content .language-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu-content .language-list li {
            padding: 8px 12px;
            text-align: center;
        }

        .menu-content .language-list li a {
            color: #2a81b2;
            text-decoration: none;
            display: block;
        }

        .menu-content .language-list li a:hover {
            background-color: #f1f1f1;
            color: #1e6392;
        }

        .language-menu:hover .menu-content {
            display: block;
        }

        .language-list .selected {
            font-weight: bold;
            color: #ff9700;
        }
    </style>


    @yield('head_css')
</head>

<body class="body">
    @include('layouts.partial.preload')
    <div id="wrapper">
        @include('layouts.partial.header') <!-- Including the header view -->
        <main>
            @yield('content')
        </main>
        @include('layouts.partial.footer')
    </div>
    {{-- @include('layouts.partial.modals') --}}
    @include('layouts.partial.scripts')
    @yield('additional_scripts')
    <a id="scroll-top" class="button-go"></a>
</body>


</html>
