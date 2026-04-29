<!DOCTYPE html>
<html>
<head>

<style>
body{
    font-family: Arial;
    background: #f4f4f4;
    margin: 0;
}

.container{
    width: 60%;
    margin: 50px auto;
    background: white;
    padding: 20px;
    border-radius: 5px;
}

select{
    width: 100%;
    padding: 8px;
    margin: 5px 0 15px 0;
}

button{
    padding: 10px 15px;
    background: #333;
    color: white;
    border: none;
    cursor: pointer;
}

br{
    display: none;
}
</style>

</head>

<body>

<div class="container">

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

</div>

</body>
</html>