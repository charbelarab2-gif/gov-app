<!-- Form for editing service category -->
@include('office.partials.nav')

<h1>Edit Category</h1>

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
    <a href="{{ route('service-categories.index') }}">Back to Categories</a>
</p>

<form action="{{ route('service-categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Name</label><br>
    <input type="text" name="name" value="{{ old('name', $category->name) }}" required>
    <br><br>
    <button type="submit">Update Category</button>
</form>
