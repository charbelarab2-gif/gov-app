<!DOCTYPE html>
<html>
<head>
    <title>Edit Office</title>

    <style>
        body {
            font-family: Arial;
            margin: 0;
            background: #f4f4f4;
        }

        .container {
            width: 70%;
            margin: 40px auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px 0;
        }

        button {
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

<h1>Edit Office</h1>

<form method="POST" action="/admin/offices/{{ $office->id }}/update">
@csrf

<label>Office Name</label>
<input type="text" name="name" value="{{ $office->name }}">

<br><br>

<label>Municipality</label>

<select name="municipality_id">
    @foreach($municipalities as $m)
        <option value="{{ $m->id }}"
            @if($office->municipality_id == $m->id) selected @endif>
            {{ $m->name }}
        </option>
    @endforeach
</select>

<br><br>

<label>Address</label>
<input type="text" name="address" value="{{ $office->address }}">

<br><br>

<button type="submit">Update Office</button>

</form>

</div>

</body>
</html>