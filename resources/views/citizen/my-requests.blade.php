<h1>My Requests</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<ul>
@foreach($requests as $request)
    <li>
        {{ $request->service_name }} - Status: {{ $request->status }}

        <!-- Show Pay Now link only if not paid -->
        @if($request->status != 'Paid')
            <a href="{{ route('citizen.payment.form', ['requestId' => $request->id]) }}">Pay Now</a>
    </li>
@endforeach
</ul>