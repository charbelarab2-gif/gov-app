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