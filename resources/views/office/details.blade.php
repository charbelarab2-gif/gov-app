<h1>Office Details</h1>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/office/details">
    @csrf

    <label>Name</label><br>
    <input type="text" name="name" value="{{ old('name', $office->name) }}"><br><br>

    <label>Email</label><br>
    <input type="text" name="email" value="{{ old('email', $office->email) }}"><br><br>

    <label>Phone</label><br>
    <input type="text" name="phone" value="{{ old('phone', $office->phone) }}"><br><br>

    <label>Address</label><br>
    <input type="text" name="address" value="{{ old('address', $office->address) }}"><br><br>

    <label>Google Maps Link</label><br>
    <input type="url" name="google_maps_url" value="{{ old('google_maps_url', $office->google_maps_url) }}"><br><br>

    <label>Latitude</label><br>
    <input type="text" name="latitude" value="{{ old('latitude', $office->latitude) }}"><br><br>

    <label>Longitude</label><br>
    <input type="text" name="longitude" value="{{ old('longitude', $office->longitude) }}"><br><br>

    <label>Working Hours</label><br>
    <input type="text" name="working_hours" value="{{ old('working_hours', $office->working_hours) }}"><br><br>

    <label>Contact Info</label><br>
    <input type="text" name="contact_info" value="{{ old('contact_info', $office->contact_info) }}"><br><br>

    <button type="submit">Save</button>
</form>

<hr>

<h2>Location Preview</h2>

@if ($office->google_maps_url)
    <p>
        <a href="{{ $office->google_maps_url }}" target="_blank" rel="noopener noreferrer">Open Google Maps</a>
    </p>
@endif

@if ($office->latitude && $office->longitude)
    <iframe
        src="https://www.google.com/maps?q={{ $office->latitude }},{{ $office->longitude }}&z=15&output=embed"
        width="100%"
        height="350"
        style="border:0;"
        allowfullscreen
        loading="lazy">
    </iframe>
@elseif ($office->address)
    <iframe
        src="https://www.google.com/maps?q={{ urlencode($office->address) }}&z=15&output=embed"
        width="100%"
        height="350"
        style="border:0;"
        allowfullscreen
        loading="lazy">
    </iframe>
@else
    <p>Add an address or coordinates to preview the office location on Google Maps.</p>
@endif