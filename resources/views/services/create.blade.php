<h1>Add Service</h1>
<form method="POST" action="{{ route('services.store') }}">
   @csrf
<label>Name</label><br>
<input type="text" name="name"><br><br>
<label>Description</label><br>
<textarea name="description"></textarea><br><br>
<label>Fee</label><br>
<input type="number" name="fee"><br><br>
<label>Duration (minutes)</label><br>
<input type="number" name="duration"><br><br>
<label>Required Documents</label><br>
<textarea name="required_documents"></textarea><br><br>
<button type="submit">Save</button>
</form>