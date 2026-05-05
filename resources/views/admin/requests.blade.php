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
    width: 85%;
    margin: 40px auto;
    background: white;
    padding: 20px;
    border-radius: 5px;
}

table{
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th, td{
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

button{
    padding: 6px 10px;
    background: #333;
    color: white;
    border: none;
    cursor: pointer;
    margin-top: 5px;
}

form{
    margin: 0;
}
</style>

</head>

<body>

<div class="container">

<h1>All Requests</h1>

<table border="1">

<tr>
<th>ID</th>
<th>User</th>
<th>Office</th>
<th>Title</th>
<th>Status</th>
<th>Action</th>
</tr>

@foreach($requests as $request)

<tr>

<td>{{ $request->id }}</td>

<td>{{ $request->user->name }}</td>

<td>{{ $request->service->office->name }}</td>

<td>{{ $request->service->name }}</td>

<td>{{ $request->status }}</td>

<td>

@if($request->status == 'pending')

<form method="POST" action="/admin/requests/{{ $request->id }}/approve">
@csrf
<button type="submit">Approve</button>
</form>

<form method="POST" action="/admin/requests/{{ $request->id }}/reject">
@csrf
<button type="submit">Reject</button>
</form>

@endif

</td>

</tr>

@endforeach

</table>

</div>

</body>
</html>