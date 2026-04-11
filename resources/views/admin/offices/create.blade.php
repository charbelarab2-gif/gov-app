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