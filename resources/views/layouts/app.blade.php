<!-- Main application layout used for authenticated user pages -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gov App') }}</title>

    <!-- Vite CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Leaflet CSS/JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>
<body class="font-sans antialiased">

    <!-- Top Navigation Bar -->
    @include('layouts.navigation')

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2 bg-light min-vh-100 p-3">
                @include('layouts.sidebar')
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <!-- Optional Header -->
                @isset($header)
                    <div class="mb-4">
                        {{ $header }}
                    </div>
                @endisset

                <!-- Page Content -->
                @hasSection('content')
                    @yield('content')
                @else
                    {{ $slot ?? '' }}
                @endif
            </div>

        </div>
    </div>

    @stack('scripts')
</body>
</html>

