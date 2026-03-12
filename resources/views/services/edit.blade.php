@include('office.partials.nav')

<h1>Edit Service</h1>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('services.update', $service->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Category</label><br>
    <select name="service_category_id" required>
        <option value="">Select Category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('service_category_id', $service->service_category_id) == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <br><br>

    <label>Name</label><br>
    <input type="text" name="name" value="{{ old('name', $service->name) }}">
    <br><br>

    <label>Description</label><br>
    <textarea name="description">{{ old('description', $service->description) }}</textarea>
    <br><br>

    <label>Fee</label><br>
    <input type="number" step="0.01" name="fee" value="{{ old('fee', $service->fee) }}">
    <br><br>

    <label>Duration (minutes)</label><br>
    <input type="number" name="duration" value="{{ old('duration', $service->duration) }}">
    <br><br>

    <label>Required Documents</label><br>
    <textarea name="required_documents">{{ old('required_documents', $service->required_documents) }}</textarea>
    <br><br>

    <button type="submit">Update</button>
</form>