{{-- resources/views/services/index.blade.php --}}
<h1>Services</h1>
<a href="{{ route('services.create') }}">Add Service</a>
<table border="1" cellpadding="8">
<tr>
<th>ID</th>
<th>Name</th>
<th>Description</th>
<th>Fee</th>
<th>Action</th>
</tr>
   @forelse($services as $service)
<tr>
<td>{{ $service->id }}</td>
<td>{{ $service->name }}</td>
<td>{{ $service->description }}</td>
<td>{{ $service->fee }}</td>
<td>
               {{-- Edit --}}
<a href="{{ route('services.edit', $service->id) }}">Edit</a>
               {{-- Request (Citizen creates a request for this service) --}}
<form action="{{ route('requests.store') }}" method="POST" style="display:inline;">
                   @csrf
<input type="hidden" name="service_id" value="{{ $service->id }}">
<button type="submit">Request</button>
</form>
               {{-- Delete (Office deletes service) --}}
<form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
                   @csrf
                   @method('DELETE')
<button type="submit" onclick="return confirm('Are you sure you want to delete this service?')">
                       Delete
</button>
</form>
</td>
</tr>
   @empty
<tr>
<td colspan="5">No services found.</td>
</tr>
   @endforelse
</table>