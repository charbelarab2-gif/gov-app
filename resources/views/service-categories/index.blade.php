{{-- Display list of service categories --}}
@include('office.partials.nav')
<h1>Service Categories</h1>
{{-- Display success message --}}
@if (session('success'))
<p style="color: green;">{{ session('success') }}</p>
@endif
{{-- Display validation errors --}}
@if ($errors->any())
<div style="color: red;">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
{{-- Navigation back to services --}}
<p>
<a href="{{ route('services.index') }}">⬅️ Back to Services</a>
</p>
{{-- Form to add new category --}}
<h2>Add Category</h2>
<form method="POST" action="{{ route('service-categories.store') }}">
@csrf
{{-- Category name --}}
<label>Name</label><br>
<input type="text" name="name" value="{{ old('name') }}" required>
<br><br>
{{-- Submit button --}}
<button type="submit">💾 Save Category</button>
</form>
<hr>
{{-- Display all categories --}}
<h2>All Categories</h2>
<table border="1" cellpadding="8" style="width:100%; border-collapse: collapse;">
{{-- Table header --}}
<tr style="background:#eee;">
<th>ID</th>
<th>Name</th>
<th>Actions</th>
</tr>
{{-- Loop through categories --}}
@forelse ($categories as $category)
<tr>
{{-- Category ID --}}
<td>{{ $category->id }}</td>
{{-- Category Name --}}
<td>{{ $category->name }}</td>
{{-- Actions --}}
<td>
{{-- Edit button --}}
<a href="{{ route('service-categories.edit', $category->id) }}">
✏️ Edit
</a>
{{-- Delete form --}}
<form action="{{ route('service-categories.destroy', $category->id) }}"
method="POST"
style="display:inline;">
@csrf
@method('DELETE')
<button type="submit"
onclick="return confirm('Are you sure you want to delete this category?')">
🗑 Delete
</button>
</form>
</td>
</tr>
{{-- If no categories found --}}
@empty
<tr>
<td colspan="3" style="text-align:center;">
No categories found.
</td>
</tr>
@endforelse
</table>