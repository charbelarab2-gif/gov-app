<ul class="nav flex-column">
    @auth
        @if(auth()->user()->role === 'admin')
            <li class="nav-item"><a class="nav-link" href="/admin">Admin Panel</a></li>
        @elseif(auth()->user()->role === 'office')
            <li class="nav-item"><a class="nav-link" href="/office">Office Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="/office/details">Office Details</a></li>
            <li class="nav-item"><a class="nav-link" href="/services">Services</a></li>
            <li class="nav-item"><a class="nav-link" href="/service-categories">Service Categories</a></li>
            <li class="nav-item"><a class="nav-link" href="/office/appointments">Appointments</a></li>
            <li class="nav-item"><a class="nav-link" href="/office/requests">Requests</a></li>
            <li class="nav-item"><a class="nav-link" href="/profile">Profile / 2FA</a></li>
        @else
            <li class="nav-item"><a class="nav-link" href="/dashboard">My Requests</a></li>
        @endif
    @endauth
</ul>