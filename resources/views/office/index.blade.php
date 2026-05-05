<!-- Display list of citizen requests with approve and reject actions -->
<h1>Incoming Requests</h1>
<table border="1" cellpadding="8">
<tr>
<th>ID</th>
<th>User</th>
<th>Service</th>
<th>Status</th>
<th>Action</th>
</tr>
<!-- Loop through requests -->
@forelse($requests as $req)
<tr>
<td>{{ $req->id }}</td>
<td>
{{ $req->user->name ?? $req->user_id }}
</td>
<td>
{{ $req->service->name ?? $req->service_id }}
</td>
<td>
{{ $req->status }}
</td>
<td>
<!-- Approve request -->
<form action="/requests/{{ $req->id }}/approve" method="POST" style="display:inline;">
@csrf
<button type="submit">Approve</button>
</form>
<!-- Reject request -->
<form action="/requests/{{ $req->id }}/reject" method="POST" style="display:inline;">
@csrf
<button type="submit">Reject</button>
</form>
</td>
</tr>
@empty
<tr>
<td colspan="5">No requests yet</td>
</tr>
@endforelse
</table>