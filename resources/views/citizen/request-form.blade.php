<h1>Submit Request</h1>

<form method="POST" action="{{ route('citizen.request.store') }}" enctype="multipart/form-data">
    @csrf

    <!-- Service ID -->
    <input type="hidden" name="service_id" value="{{ $service->id }}">

    <!-- Description -->
    <label>Description</label><br>
    <textarea name="description"></textarea>

    <br><br>

    <!-- File Upload -->
    <label>Upload Document</label><br>
    <input type="file" name="document">

    <br><br>

    <button type="submit">Submit Request</button>
</form>