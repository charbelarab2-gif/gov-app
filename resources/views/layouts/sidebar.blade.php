<ul class="nav flex-column">
    @auth
        @if(auth()->user()->role === 'admin')
            <li class="nav-item">
                <a class="nav-link active" href="/admin">🛡️ Admin Panel</a>
            </li>
        @elseif(auth()->user()->role === 'office')
            <li class="nav-item">
                <a class="nav-link active" href="/office">🏢 Office Panel</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="/citizen">🏠 My Requests</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/services">📋 Services</a>
            </li>
        @endif
    @endauth
</ul>