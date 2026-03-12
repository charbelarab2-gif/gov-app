@include('office.partials.nav')

<h1>Add Service</h1>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if ($categories->isEmpty())
    <p>You need to create a category before adding a service.</p>
    <a href="{{ route('service-categories.index') }}">Go to Categories</a>
@else
    <form method="POST" action="{{ route('services.store') }}">
        @csrf

        <label>Category</label><br>
        <select name="service_category_id" required>
            <option value="">Select Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('service_category_id') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <br><br>

        <label>Name</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br><br>

        <label>Description</label><br>
        <textarea name="description">{{ old('description') }}</textarea><br><br>

        <label>Fee</label><br>
        <input type="number" step="0.01" name="fee" value="{{ old('fee') }}"><br><br>

        <label>Duration (minutes)</label><br>
        <input type="number" name="duration" value="{{ old('duration') }}"><br><br>

        <label>Required Documents</label><br>
        <textarea name="required_documents">{{ old('required_documents') }}</textarea><br><br>

        <button type="submit">Save</button>
    </form>
@endif