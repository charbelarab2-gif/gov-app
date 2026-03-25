@component('mail::message')
# Request Update

Your request **#{{ $request->id }}** status has changed to: **{{ $request->status }}**

@component('mail::button', ['url' => route('requests.show', $request->id)])
View Request
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent