<h1>Edit Office</h1>

<form method="POST" action="/admin/offices/{{ $office->id }}/update">
@csrf

<label>Office Name</label>
<br>
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
<br>
<input type="text" name="address" value="{{ $office->address }}">
<br><br>

<button type="submit">Update Office</button>

</form>