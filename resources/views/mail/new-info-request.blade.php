@component('mail::message')
# Nuova richiesta di informazioni 

{{ $title }}

{{ $body }}

@component('mail::button', ['url' => config('app.url')])
View Apartment
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent


{{-- view method --}}
{{-- <h1>Nuova richiesta di informazioni</h1>

<p>ricevuta da: <strong>{{ $title }}</strong></p>
<p>ogetto della richiesta: <strong>{{ $body }}</strong></p> --}}
