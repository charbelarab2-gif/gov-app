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
    margin-top: 15px;
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
}

a button{
    margin-bottom: 10px;
}
</style>

</head>

<body>

<div class="container">

<h1>Users</h1>

<a href="/admin/users/create">
    <button>Create New User</button>
</a>

<table border="1">

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Status</th>
<th>Action</th>
</tr>

@foreach($users as $user)

<tr>

<td>{{ $user->id }}</td>

<td>{{ $user->name }}</td>

<td>{{ $user->email }}</td>

<td>{{ $user->role }}</td>

<td>{{ $user->is_active }}</td> <!-- FIXED -->

<td>

@if($user->is_active == 0) <!-- FIXED -->

<form method="POST" action="/admin/users/{{ $user->id }}/activate">

@csrf

<button type="submit">
Activate
</button>

</form>

@endif

</td>


<td>

@if($user->is_active == 0) <!-- FIXED -->

<form method="POST" action="/admin/users/{{ $user->id }}/activate">
@csrf
<button type="submit">Activate</button>
</form>

@else

<form method="POST" action="/admin/users/{{ $user->id }}/deactivate">
@csrf
<button type="submit">Deactivate</button>
</form>

@endif

</td>

</tr>

@endforeach 

</table>

</div>

</body>
</html>