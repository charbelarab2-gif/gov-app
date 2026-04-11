<h1>Manage Services</h1>

<h2>Create Category</h2>

<form method="POST" action="/admin/services/category">
@csrf

<input type="text" name="name" placeholder="Category Name" required>

<select name="office_id" required>
@foreach($offices as $office)
    <option value="{{ $office->id }}">
        {{ $office->name }}
    </option>
@endforeach
</select>

<button type="submit">Create Category</button>
</form>



<h2>Create Service</h2>

<form method="POST" action="/admin/services">
@csrf

<input type="text" name="name" placeholder="Service Name" required>

<input type="text" name="description" placeholder="Description">

<input type="number" name="fee" placeholder="Fee">

<select name="office_id" required>
@foreach($offices as $office)
    <option value="{{ $office->id }}">
        {{ $office->name }}
    </option>
@endforeach
</select>

<select name="service_category_id" required>
@foreach($categories as $category)
    <option value="{{ $category->id }}">
        {{ $category->name }} ({{ optional($category->office)->name }})
    </option>
@endforeach
</select>

<button type="submit">Create Service</button>
</form>



<h2>All Categories</h2>

<table border="1">
<tr>
<th>ID</th>
<th>Name</th>
<th>Office</th>
<th>Action</th>
</tr>

@foreach($categories as $category)
<tr>
<td>{{ $category->id }}</td>
<td>{{ $category->name }}</td>
<td>{{ optional($category->office)->name }}</td>

<td>
<a href="/admin/category/{{ $category->id }}/edit">Edit</a>
<form method="POST" action="/admin/category/{{ $category->id }}/delete">
@csrf
<button type="submit">Delete</button>
</form>
</td>

</tr>
@endforeach
</table>



<h2>All Services</h2>

<table border="1">
<tr>
<th>ID</th>
<th>Name</th>
<th>Category</th>
<th>Office</th>
<th>Fee</th>
<th>Action</th>
</tr>

@foreach($services as $service)
<tr>
<td>{{ $service->id }}</td>
<td>{{ $service->name }}</td>
<td>{{ optional($service->category)->name }}</td>
<td>{{ optional($service->office)->name }}</td>
<td>{{ $service->fee }}</td>

<td>
<a href="/admin/service/{{ $service->id }}/edit">Edit</a>
<form method="POST" action="/admin/service/{{ $service->id }}/delete">
@csrf
<button type="submit">Delete</button>
</form>
</td>

</tr>
@endforeach
</table>