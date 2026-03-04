<h1>Services</h1>
<a href="{{ route('services.create') }}">Add Service</a>
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
</td>
</tr>
@endforeach
</table>