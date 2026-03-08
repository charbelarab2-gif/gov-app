@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Office Locations</h5>
    </div>
    <div class="card-body">
        <div id="map" style="height: 500px; width: 100%;"></div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const map = L.map('map').setView([33.8547, 35.8623], 9);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    const offices = @json($offices);

    offices.forEach(office => {
        if (office.latitude && office.longitude) {
            L.marker([office.latitude, office.longitude])
                .addTo(map)
                .bindPopup(`<b>${office.name}</b>`);
        }
    });
</script>
@endpush