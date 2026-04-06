<h1>Offices</h1>

<a href="/admin/offices/create">Add Office</a>

<table border="1">

<tr>
<th>Name</th>
<th>Municipality</th>
<th>Address</th>
<th>Action</th>
</tr>

@foreach($offices as $office)

<tr>
<td>{{ $office->name }}</td>
<td>{{ $office->municipality }}</td>
<td>{{ $office->address }}</td>

<td>

<a href="/admin/offices/{{ $office->id }}/edit">
Edit
</a>

<form method="POST" action="/admin/offices/{{ $office->id }}">
@csrf
@method('DELETE')
<button type="submit">Delete</button>
</form>

</td>

</tr>

@endforeach

</table>