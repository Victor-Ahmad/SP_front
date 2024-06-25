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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .navigation li a {
            color: #2a81b2 !important;
        }

        .navigation li a:hover {
            color: #ff9700 !important;
        }

        .widget-logo-footer {
            padding: 10px 0;
        }


        .language-switcher {
            position: relative;
            display: inline-block;
        }

        .auth_btn {
            color: #2a81b2;
        }

        .menu-btn {
            background-color: transparent !important;
            color: #2a81b2;
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
            display: block !important;
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

        /* Large Devices (laptops/desktops, 992px to 1200px) */
        @media (max-width: 1200px) {}

        /* Medium Devices (landscape tablets, 768px to 992px) */
        @media (max-width: 992px) {}


        /* Small Devices (portrait tablets and large phones, 600px to 768px) */
        @media (max-width: 768px) {}

        /* Extra Small Devices (phones, 600px and down) */
        @media (max-width: 600px) {}

        .position-relative {
            position: relative;
        }

        .badge {
            position: absolute;
            top: 10px;
            right: -10px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 4px 7px;
            font-size: 8px;
            font-weight: bold;
        }

        .social-media-icons {
            margin-left: 18vw;
        }

        .social-media-icons .social-icon {
            margin-right: 10px;
            color: #2a81b2;
            font-size: 14px;
            transition: color 0.3s;
        }

        .fa-facebook-f,
        .fa-instagram {
            font-size: 20px;
            margin-right: 5px;
        }

        .social-media-icons .social-icon:hover {
            color: #FF9700;
        }

        .main-menu .facebook_custom {
            margin-left: 15vw;
        }

        .mobile-menu .facebook_custom {
            margin-top: 15vw;
        }
    </style>


    @yield('head_css')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>
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
    <script>
        function createPreloader() {
            var preloadContainer = document.createElement('div');
            preloadContainer.className = 'preload preload-container';

            var boxesContainer = document.createElement('div');
            boxesContainer.className = 'boxes';

            for (var i = 0; i < 4; i++) {
                var box = document.createElement('div');
                box.className = 'box';

                for (var j = 0; j < 4; j++) {
                    var innerDiv = document.createElement('div');
                    box.appendChild(innerDiv);
                }

                boxesContainer.appendChild(box);
            }

            preloadContainer.appendChild(boxesContainer);

            document.body.appendChild(preloadContainer);
        }

        function removePreloader() {
            setTimeout(function() {
                var preloadContainer = document.querySelector('.preload.preload-container');
                if (preloadContainer) {
                    preloadContainer.remove();
                }
            }, 400); // 400 milliseconds delay
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sessionToken = '{{ session('token') }}';

            function fetchUnreadMessages() {
                fetch('{{ route('checkUnreadMessages') }}')
                    .then(response => response.json())
                    .then(data => {
                        const unreadCountElement = document.getElementById('unread-count');
                        if (data.unreadCount > 0) {
                            unreadCountElement.textContent = data.unreadCount;
                            unreadCountElement.style.display = 'inline';
                        } else {
                            unreadCountElement.style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching unread messages:', error);
                    });
            }

            if (sessionToken) {
                fetchUnreadMessages();
            }

            // Optionally, refresh the count every minute
            // setInterval(fetchUnreadMessages, 60000);
        });
    </script>
    <a id="scroll-top" class="button-go"></a>
</body>


</html>
