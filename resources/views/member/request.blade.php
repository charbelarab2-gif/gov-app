<form method="POST" action="{{ route('requests.store') }}">
@csrf

<!-- OFFICE -->
<select name="office_id">
    <option value="">Select Office</option>
    @foreach($offices as $office)
        <option value="{{ $office->id }}">
            {{ $office->name }}
        </option>
    @endforeach
</select>

<br><br>

<!-- CATEGORY -->
<select name="category_id">
    <option value="">Select Category</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}">
            {{ $category->name }}
        </option>
    @endforeach
</select>

<br><br>

<!-- SERVICE -->
<select name="service_id">
    <option value="">Select Service</option>
    @foreach($services as $service)
        <option value="{{ $service->id }}">
            {{ $service->name }}
        </option>
    @endforeach
</select>

<br><br>

<button type="submit">Submit</button>

</form>