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

<td>{{ $request->office->name }}</td>

<td>{{ $request->title }}</td>

<td>{{ $request->status }}</td>

<td>

@if($request->status == 'Pending')

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