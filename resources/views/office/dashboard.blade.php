@include('office.partials.nav')

<h1>Office Dashboard</h1>


<ul>
    <li><a href="{{ url('/office/details') }}">Office Details and Google Maps</a></li>
    <li><a href="{{ route('service-categories.index') }}">Service Categories</a></li>
    <li><a href="{{ route('services.index') }}">Services</a></li>
    <li><a href="{{ route('office.appointments') }}">Appointments and Email Reminders</a></li>
    <li><a href="{{ route('office.requests') }}">Requests and Response Uploads</a></li>
    <li><a href="{{ route('profile.edit') }}">Profile and Two-Factor Authentication</a></li>
</ul>
