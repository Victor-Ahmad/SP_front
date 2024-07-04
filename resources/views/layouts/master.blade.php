<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Default Title')</title>
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Open Graph meta tags -->
    <meta property="og:title" content="@yield('og_title', 'Default Title')" />
    <meta property="og:description" content="@yield('og_description', 'A brief description of your page')" />
    <meta property="og:image" content="@yield('og_image', asset('assets/images/default_image.jpg'))" />
    <meta property="og:url" content="@yield('og_url', url()->current())" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Your Site Name" />
    <meta property="og:locale" content="en_US" />

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
    <link rel="stylesheet"
        href="{{ asset('app/css/master.css') }}?v={{ filemtime(public_path('app/css/master.css')) }}">


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
