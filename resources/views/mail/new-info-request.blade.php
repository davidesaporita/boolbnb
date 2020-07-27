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
