<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Citizen Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark px-4">
        <span class="navbar-brand">E-Service Platform</span>

        <div class="text-white">
            Welcome, {{ auth()->user()->name }}
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger btn-sm">Logout</button>
        </form>
    </nav>

    <!-- Main Container -->
    <div class="container mt-5">

        <h2 class="mb-4">Citizen Dashboard</h2>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Cards -->
        <div class="row">

            <!-- Browse Services -->
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title">Browse Services</h5>
                        <p class="card-text">View and request available services.</p>
                        <a href="/services" class="btn btn-primary">View Services</a>
                    </div>
                </div>
            </div>

            <!-- My Requests -->
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title">My Requests</h5>
                        <p class="card-text">Track your submitted requests.</p>
                        <a href="/my-requests" class="btn btn-success">View Requests</a>
                    </div>
                </div>
            </div>

            <!-- Profile (Future Feature) -->
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h5 class="card-title">Profile</h5>
                        <p class="card-text">Manage your personal information.</p>
                        <a href="{{ route('profile.edit') }}" class="btn btn-secondary">
    View Profile
</a>
                    </div>
                </div>
            </div>

        </div>

    </div>

</body>
</html>