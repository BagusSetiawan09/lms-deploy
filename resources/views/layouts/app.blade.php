<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        {{-- <link rel="icon" href="{{ asset('image/icon-logo.png') }}" type="image/png"> --}}

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
        <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        
    </head>
    <body class="@stack('font-class') antialiased">
        <div class="min-h-screen @stack('bg-class')">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script>
            function onYouTubeIframeAPIReady() {
                const player = new YT.Player('mainPlayer', {
                    events: {
                        'onStateChange': function (event) {
                            if (event.data === YT.PlayerState.ENDED) {
                                window.postMessage('video-ended', '*');
                            }

                            // Catat progres saat video dipause atau saat berakhir
                            if (event.data === YT.PlayerState.PAUSED || event.data === YT.PlayerState.ENDED) {
                                const currentTime = player.getCurrentTime();
                                const videoId = player.getVideoData().video_id;

                                fetch('/video-progress', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                    },
                                    body: JSON.stringify({
                                        video_id: videoId,
                                        progress: currentTime
                                    })
                                });
                            }
                        }
                    }
                });
            }

            const tag = document.createElement('script');
            tag.src = "https://www.youtube.com/iframe_api";
            const firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        </script>

    </body>
</html>
