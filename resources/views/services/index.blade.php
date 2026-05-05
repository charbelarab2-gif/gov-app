{{-- Include office navigation sidebar/menu --}}
@include('office.partials.nav')
<h1>Services</h1>
{{-- Display success message after operations --}}
@if (session('success'))
<p style="color: green;">{{ session('success') }}</p>
@endif
{{-- Action links for creating service and managing categories --}}
<p>
<a href="{{ route('services.create') }}">➕ Add Service</a> |
<a href="{{ route('service-categories.index') }}">📂 Manage Categories</a>
</p>
{{-- Services table --}}
<table border="1" cellpadding="8" style="width:100%; border-collapse: collapse;">
{{-- Table header --}}
<tr style="background-color: #f2f2f2;">
<th>ID</th>
<th>Category</th>
<th>Name</th>
<th>Description</th>
<th>Fee</th>
<th>Duration</th>
<th>Required Documents</th>
<th>Actions</th>
</tr>
{{-- Loop through all services --}}
@forelse ($services as $service)
<tr>
{{-- Service ID --}}
<td>{{ $service->id }}</td>
{{-- Service Category (fallback if null) --}}
<td>{{ $service->category->name ?? 'Uncategorized' }}</td>
{{-- Service Name --}}
<td>{{ $service->name }}</td>
{{-- Description --}}
<td>{{ $service->description }}</td>
{{-- Fee --}}
<td>{{ $service->fee }}</td>
{{-- Duration --}}
<td>{{ $service->duration }}</td>
{{-- Required Documents --}}
<td>{{ $service->required_documents }}</td>
{{-- Actions (Edit + Delete) --}}
<td>
{{-- Edit button --}}
<a href="{{ route('services.edit', $service->id) }}">
✏️ Edit
</a>
{{-- Delete form --}}
<form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
@csrf
@method('DELETE')
<button type="submit"
onclick="return confirm('Are you sure you want to delete this service?')">
🗑 Delete
</button>
</form>
</td>
</tr>
{{-- If no services found --}}
@empty
<tr>
<td colspan="8" style="text-align:center;">
No services found.
</td>
</tr>
@endforelse
</table>