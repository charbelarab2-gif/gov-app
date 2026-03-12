@include('office.partials.nav')

<h1>Service Categories</h1>

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

<p>
    <a href="{{ route('services.index') }}">Back to Services</a>
</p>

<h2>Add Category</h2>
<form method="POST" action="{{ route('service-categories.store') }}">
    @csrf
    <label>Name</label><br>
    <input type="text" name="name" value="{{ old('name') }}" required>
    <br><br>
    <button type="submit">Save Category</button>
</form>

<hr>

<h2>All Categories</h2>
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Actions</th>
    </tr>
    @forelse ($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>
                <a href="{{ route('service-categories.edit', $category->id) }}">Edit</a>
                <form action="{{ route('service-categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this category?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3">No categories found.</td>
        </tr>
    @endforelse
</table>
