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
    width: 70%;
    margin: 40px auto;
    background: white;
    padding: 20px;
    border-radius: 5px;
}

input, select{
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
</style>

</head>

<body>

<div class="container">

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

</div>

</body>
</html>