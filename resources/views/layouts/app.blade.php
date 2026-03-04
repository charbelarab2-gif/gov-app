<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                @else
                    <a href="/login" class="btn btn-outline-light btn-sm">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- SIDEBAR -->
            @auth
            <div class="col-md-2 bg-light min-vh-100 p-3">
                @include('layouts.sidebar')
            </div>
            @endauth
            <!-- MAIN CONTENT -->
            <div class="{{ auth()->check() ? 'col-md-10' : 'col-md-12' }} p-4">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>