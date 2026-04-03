<form method="POST" action="/request">
@csrf

<select name="office_id">

@foreach($offices as $office)
<option value="{{ $office->id }}">
{{ $office->name }}
</option>
@endforeach

</select>

<input type="text" name="service" placeholder="Service name">

<button type="submit">
Submit
</button>

</form>