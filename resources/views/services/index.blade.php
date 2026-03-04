<h1>Services</h1>
<a href="{{ route('services.create') }}">Add Service</a>
@if(session('success'))
<p style="color:green; font-weight:bold;">
       {{ session('success') }}
</p>
@endif
<table border="1">
<tr>
<th>ID</th>
<th>Name</th>
<th>Description</th>
<th>Fee</th>
<th>Action</th>
</tr>
   @foreach($services as $service)
<tr>
<td>{{ $service->id }}</td>
<td>{{ $service->name }}</td>
<td>{{ $service->description }}</td>
<td>{{ $service->fee }}</td>
<td>
<a href="{{ route('services.edit', $service->id) }}">Edit</a>
<form action="{{ route('requests.store') }}" method="POST" style="display:inline;">
                   @csrf
<input type="hidden" name="service_id" value="{{ $service->id }}">
<button type="submit">Request</button>
</form>
</td>
</tr>
   @endforeach
</table>