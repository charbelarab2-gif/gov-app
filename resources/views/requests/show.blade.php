@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Request #{{ $request->id }}</h5>
    </div>
    <div class="card-body">
        <p><strong>Status:</strong> {{ $request->status }}</p>

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
    const requestId = {{ $request->id }};

    Echo.channel('requests.' + requestId)
        .listen('RequestStatusUpdated', (e) => {
            document.querySelector('p strong').nextSibling.textContent = ' ' + e.status;
        });
</script>
@endpush