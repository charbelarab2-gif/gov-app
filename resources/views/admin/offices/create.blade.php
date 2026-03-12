<h1>Create Office</h1>

<form method="POST" action="/admin/offices">
@csrf

<label>Office Name</label>
<input type="text" name="name">

<br><br>

<label>Municipality</label>
<input type="text" name="municipality">

<br><br>

<label>Address</label>
<input type="text" name="address">

<br><br>

<button type="submit">Save Office</button>

</form>