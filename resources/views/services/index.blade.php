<h1>Services</h1>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<p>
    <a href="{{ route('services.create') }}">Add Service</a>
    <a href="{{ route('service-categories.index') }}">Manage Categories</a>
</p>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Category</th>
        <th>Name</th>
        <th>Description</th>
        <th>Fee</th>
        <th>Duration</th>
        <th>Required Documents</th>
        <th>Action</th>
    </tr>
    @forelse ($services as $service)
        <tr>
            <td>{{ $service->id }}</td>
            <td>{{ $service->category->name ?? 'Uncategorized' }}</td>
            <td>{{ $service->name }}</td>
            <td>{{ $service->description }}</td>
            <td>{{ $service->fee }}</td>
            <td>{{ $service->duration }}</td>
            <td>{{ $service->required_documents }}</td>
            <td>
                <a href="{{ route('services.edit', $service->id) }}">Edit</a>
                <form action="{{ route('requests.store') }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    <button type="submit">Request</button>
                </form>
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
            <td colspan="8">No services found.</td>
        </tr>
    @endforelse
</table>