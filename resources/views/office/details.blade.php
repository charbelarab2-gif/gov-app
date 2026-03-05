<h1>Office Details</h1>
<form method="POST" action="/office/details">
   @csrf
<label>Name</label><br>
<input type="text" name="name" value="{{ $office->name }}"><br><br>
<label>Email</label><br>
<input type="text" name="email" value="{{ $office->email }}"><br><br>
<label>Phone</label><br>
<input type="text" name="phone" value="{{ $office->phone }}"><br><br>
<label>Address</label><br>
<input type="text" name="address" value="{{ $office->address }}"><br><br>
<label>Latitude</label><br>
<input type="text" name="latitude" value="{{ $office->latitude }}"><br><br>
<label>Longitude</label><br>
<input type="text" name="longitude" value="{{ $office->longitude }}"><br><br>
<label>Working Hours</label><br>
<input type="text" name="working_hours" value="{{ $office->working_hours }}"><br><br>
<label>Contact Info</label><br>
<input type="text" name="contact_info" value="{{ $office->contact_info }}"><br><br>
<button type="submit">Save</button>
</form>