<h1>Request Service</h1>

<form method="POST" action="/request/store" enctype="multipart/form-data">

@csrf

<input type="hidden" name="service_id" value="{{ $service->id }}">

<label>Description</label>
<textarea name="description"></textarea>

<br><br>

<label>Upload Document</label>
<input type="file" name="document">

<br><br>

<button type="submit">Submit Request</button>

</form>