<h1>Incoming Requests</h1>
<table border="1">
<tr>
<th>ID</th>
<th>User</th>
<th>Service</th>
<th>Status</th>
</tr>
   @foreach($requests as $req)
<tr>
<td>{{ $req->id }}</td>
<td>{{ $req->user->name ?? $req->user_id }}</td>
<td>{{ $req->service->name ?? $req->service_id }}</td>
<td>{{ $req->status }}</td>
</tr>
   @endforeach
</table>