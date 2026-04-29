<!DOCTYPE html>
<html>
<head>
<style>
body{font-family:Arial;background:#f4f4f4;}
.container{width:70%;margin:40px auto;background:white;padding:20px;}
input,select,button{width:100%;padding:8px;margin:10px 0;}
button{background:#333;color:white;border:none;}
</style>
</head>
<body>

<div class="container">

<h1>Edit Category</h1>

<form method="POST" action="/admin/category/{{ $category->id }}/update">
@csrf

<input type="text" name="name" value="{{ $category->name }}">

<select name="office_id">
@foreach($offices as $office)
<option value="{{ $office->id }}" {{ $category->office_id == $office->id ? 'selected' : '' }}>
{{ $office->name }}
</option>
@endforeach
</select>

<button type="submit">Update</button>

</form>

</div>
</body>
</html>