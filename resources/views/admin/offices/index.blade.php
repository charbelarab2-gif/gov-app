<!DOCTYPE html>
<html>
<head>
    <title>Offices</title>

    <style>
        body {
            font-family: Arial;
            margin: 0;
            background: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: 40px auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        a, button {
            padding: 5px 10px;
            text-decoration: none;
        }

        button {
            background: red;
            color: white;
            border: none;
        }
    </style>
</head>

<body>

<div class="container">

<h1>Offices</h1>

<a href="/admin/offices/create">Add Office</a>

<br><br>

<table>

<tr>
<th>Name</th>
<th>Municipality</th>
<th>Address</th>
<th>Action</th>
</tr>

@foreach($offices as $office)

<tr>
<td>{{ $office->name }}</td>
<td>{{ $office->municipality->name ?? 'N/A' }}</td>
<td>{{ $office->address }}</td>

<td>
<a href="/admin/offices/{{ $office->id }}/edit">Edit</a>

<form method="POST" action="/admin/offices/{{ $office->id }}" style="display:inline;">
@csrf
@method('DELETE')
<button type="submit">Delete</button>
</form>

</td>

</tr>

@endforeach

</table>

</div>

</body>
</html>