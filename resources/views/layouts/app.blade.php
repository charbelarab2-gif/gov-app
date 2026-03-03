<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gov App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">GovApp</a>
            <div class="ms-auto">
                @auth
                    <span class="text-white me-3">{{ auth()->user()->name }}</span>
                    <a href="/logout" class="btn btn-outline-light btn-sm">Logout</a>
                @else
                    <a href="/login" class="btn btn-outline-light btn-sm">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- SIDEBAR -->
            <div class="col-md-2 bg-light min-vh-100 p-3">
                @include('layouts.sidebar')
            </div>
            <!-- MAIN CONTENT -->
            <div class="col-md-10 p-4">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>