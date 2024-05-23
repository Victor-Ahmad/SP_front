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
