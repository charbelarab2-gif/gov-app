http://127.0.0.1:8000/services/1/edit
 
<h1>Edit Service</h1>
<form action="{{ route('services.update', $service->id) }}" method="POST">

    @csrf

    @method('PUT')
<label>Name</label>
<input type="text" name="name" value="{{ $service->name }}">
<br><br>
<label>Description</label>
<input type="text" name="description" value="{{ $service->description }}">
<br><br>
<label>Fee</label>
<input type="number" name="fee" value="{{ $service->fee }}">
<br><br>
<button type="submit">Update</button>
</form>
 