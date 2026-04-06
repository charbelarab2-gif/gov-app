<!-- Main application layout used for authenticated user pages -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
 
    <title>{{ config('app.name', 'Gov App') }}</title>
 
    @vite(['resources/css/app.css', 'resources/js/app.js'])
 
    <!-- Bootstrap CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
 
    <style>
        body {
            background-color: #f4f7fb;
        }
 
        .sidebar {
            min-height: 100vh;
            background: #ffffff;
            border-right: 1px solid #e9ecef;
            box-shadow: 0 0.125rem 0.5rem rgba(0, 0, 0, 0.05);
        }
 
        .main-content {
            min-height: 100vh;
            padding: 2rem;
        }
 
        .content-card {
            background: #fff;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 0.125rem 0.75rem rgba(0, 0, 0, 0.06);
        }
</style>
</head>
<body class="font-sans antialiased">
    @include('layouts.navigation')
 
    <div class="container-fluid">
<div class="row g-0">
<div class="col-md-3 col-lg-2 sidebar p-4">
                @include('layouts.sidebar')
</div>
 
            <div class="col-md-9 col-lg-10 main-content">
<div class="content-card">
                    @isset($header)
<div class="mb-4">
                            {{ $header }}
</div>
                    @endisset
 
                    @hasSection('content')
                        @yield('content')
                    @else
                        {{ $slot ?? '' }}
                    @endif
</div>
</div>
</div>
</div>
 
    @stack('scripts')
 
    <!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</body>
</html>