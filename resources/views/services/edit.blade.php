<h1>Edit Service</h1>
<form action="{{ route('services.update', $service->id) }}" method="POST">
   @csrf
   @method('PUT')
<label>Name</label><br>
<input type="text" name="name" value="{{ $service->name }}">
<br><br>
<label>Description</label><br>
<textarea name="description">{{ $service->description }}</textarea>
<br><br>
<label>Fee</label><br>
<input type="number" name="fee" value="{{ $service->fee }}">
<br><br>
<label>Duration (minutes)</label><br>
<input type="number" name="duration" value="{{ $service->duration }}">
<br><br>
<label>Required Documents</label><br>
<textarea name="required_documents">{{ $service->required_documents }}</textarea>
<br><br>
<button type="submit">Update</button>
</form>