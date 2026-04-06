<!-- Main application layout used for  authentication users pages -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Gov App</title>
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
.top-navbar {
background: linear-gradient(90deg, #0d6efd, #0b5ed7);
}
.sidebar {
min-height: 100vh;
background: #ffffff;
border-right: 1px solid #e9ecef;
box-shadow: 0 0.125rem 0.5rem rgba(0,0,0,0.05);
}
.main-content {
min-height: 100vh;
padding: 2rem;
}
.content-card {
background: #fff;
border-radius: 16px;
padding: 1.5rem;
box-shadow: 0 0.125rem 0.75rem rgba(0,0,0,0.06);
}
.brand-title {
font-weight: 700;
font-size: 1.3rem;
letter-spacing: 0.3px;
}
</style>
</head>
<body>
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark top-navbar shadow-sm">
<div class="container-fluid px-4">
<a class="navbar-brand brand-title" href="/">
<i class="bi bi-building"></i> GovApp
</a>
<div class="ms-auto d-flex align-items-center gap-2">
@auth
<span class="text-white fw-semibold me-2">
<i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
</span>
<form method="POST" action="{{ route('logout') }}" class="d-inline">
@csrf
<button type="submit" class="btn btn-light btn-sm rounded-pill px-3">
Logout
</button>
</form>
@else
<a href="/login" class="btn btn-light btn-sm rounded-pill px-3">Login</a>
@endauth
</div>
</div>
</nav>
<!-- PAGE LAYOUT -->
<div class="container-fluid">
<div class="row g-0">
<!-- SIDEBAR -->
<div class="col-md-3 col-lg-2 sidebar p-4">
@include('layouts.sidebar')
</div>
<!-- MAIN CONTENT -->
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