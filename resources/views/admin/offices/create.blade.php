<!DOCTYPE html>
<html>
<head>
    <title>Create Office</title>

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

<h1>Create Office</h1>

<form method="POST" action="/admin/offices">
@csrf

<label>Office Name</label>
<input type="text" name="name">

<br><br>

<label>Municipality</label>

<select name="municipality_id" required>
    <option value="">-- Select Municipality --</option>

    @foreach($municipalities as $m)
        <option value="{{ $m->id }}">
            {{ $m->name }}
        </option>
    @endforeach
</select>

<br><br>

<label>Email</label>
<input type="email" name="email" required>

<br><br>

<label>Address</label>
<input type="text" name="address">

<br><br>

<button type="submit">Save Office</button>

</form>

</div>

</body>
</html>