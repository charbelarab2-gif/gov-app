@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Request #{{ $request->id }}</h5>
    </div>
    <div class="card-body">
        <p><strong>Status:</strong> <span id="request-status">{{ $request->status }}</span></p>

        @if($request->qr_code_path)
            <div class="mt-3">
                <h6>QR Code:</h6>
                <img src="{{ Storage::url($request->qr_code_path) }}"
                     alt="QR Code" width="200">

                <br>
                <a href="{{ Storage::url($request->qr_code_path) }}"
                   download="request_{{ $request->id }}.png"
                   class="btn btn-sm btn-outline-primary mt-2">
                    Download QR
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const requestId = {{ $request->id }};

        if (typeof Echo !== 'undefined') {
            Echo.channel('requests.' + requestId)
                .listen('.App\\Events\\RequestStatusUpdated', (e) => {
                    document.getElementById('request-status').innerText = e.status;
                    console.log('Status updated to: ' + e.status);
                });
        } else {
            console.log('Echo not available');
        }
    });
</script>
@endpush