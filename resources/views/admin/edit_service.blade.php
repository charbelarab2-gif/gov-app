<h1>Edit Service</h1>

<form method="POST" action="/admin/service/{{ $service->id }}/update">
@csrf

<input type="text" name="name" value="{{ $service->name }}">

<input type="text" name="description" value="{{ $service->description }}">

<input type="number" name="fee" value="{{ $service->fee }}">

<select name="office_id">
@foreach($offices as $office)
    <option value="{{ $office->id }}"
        @if($office->id == $service->office_id) selected @endif>
        {{ $office->name }}
    </option>
@endforeach
</select>

<select name="service_category_id">
@foreach($categories as $category)
    <option value="{{ $category->id }}"
        @if($category->id == $service->service_category_id) selected @endif>
        {{ $category->name }}
    </option>
@endforeach
</select>

<button type="submit">Update Service</button>
</form>


