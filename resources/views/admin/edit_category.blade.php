<h1>Edit Category</h1>

<form method="POST" action="/admin/category/{{ $category->id }}/update">
@csrf

<input type="text" name="name" value="{{ $category->name }}">

<select name="office_id">
@foreach($offices as $office)
    <option value="{{ $office->id }}"
        {{ $category->office_id == $office->id ? 'selected' : '' }}>
        {{ $office->name }}
    </option>
@endforeach
</select>

<button type="submit">Update</button>
</form>

