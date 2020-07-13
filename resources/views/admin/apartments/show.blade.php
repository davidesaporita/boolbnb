@extends('layouts.app')

@section('content')
<div class="container">
        <div class="card mt-4 details-apartment">
            <div class="card-header">
                <strong>Dettagli</strong>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Proprietario: {{$apartment->user->first_name}} {{$apartment->user->last_name}}</li>
                <li class="list-group-item">Titolo: {{$apartment->title}}</li>
                <li class="list-group-item">Categoria: {{$apartment->category->name}}</li>
                <li class="list-group-item">Decsrizione: {{$apartment->description}}</li>
                <li class="list-group-item">Numero stanze: {{$apartment->rooms_number}}</li>
                <li class="list-group-item">Numero letti: {{$apartment->beds_number}}</li>
                <li class="list-group-item">Numero bagni: {{$apartment->bathrooms_number}}</li>
                <li class="list-group-item">Metri quadrati: {{$apartment->square_meters}}</li>
                <li class="list-group-item">Indirizzo: {{$apartment->address}}</li>
            </ul>
        </div>
        <div class="card mt-4 media-apartment">
            <div class="card-header">
                <strong>Media</strong>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($apartment->media as $item)
                    <li class="list-group-item">
                        {{$item->path}}
                        {{-- <img src="{{$item->path}}" alt="{{$item->type}}"> --}}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="mt-4 services-apartment">
            <div>
                <strong>Servizi disponibili</strong>
            </div>
            @forelse ($apartment->services as $service)
                <span class="badge badge-pill badge-primary">{{$service->name}}</span>
            @empty
                <p>Non ci sono servizi aggiuntivi!</p>
            @endforelse
        </div>
        <div class="mt-4 button-options">
            <a class="btn btn-sm btn-primary" href="{{route('admin.apartments.edit', $apartment->id)}}">Modifica</a>
            <form class="d-inline" action="{{route('admin.apartments.destroy', $apartment->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-sm btn-danger" value="Elimina">
            </form>
        </div>
        <div class="mt-4 sponsor-plan">
            <div>
                <strong>Piano sponsorizzazione</strong>
            </div>
            @forelse ($apartment->sponsor_plans as $plan)
                <span class="badge badge-pill badge-dark">{{$plan->name}}</span>
                <p class="mt-4">Durata sponsorizzazione: {{$plan->hours}}</p>
                <p>Termine della sponsorizzazione: {{$plan->sponsorships->deadline}}</p>
                @empty
                <p>Non ci sono sponsorizzazioni!</p>
            @endforelse
            <a class="btn btn-sm btn-dark" href="{{ route('admin.apartments.sponsorship.pay', ['apartment' => $apartment ]) }}">Nuovo Sponsor</a>
        </div>
        <div class="mt-4 comments">
            <h4>Commenti:</h4>
            @forelse ($apartment->reviews as $review)
            <h5>{{$review->first_name}} {{$review->last_name}}</h5>
            <strong>{{$review->title}}</strong>
            <p>{{$review->body}}</p>
            @empty
                <p>Non ci sono commenti!</p>
            @endforelse
        </div>

        <div id="show-map"></div>

    </div>
    <input type="hidden" id="lat" value="{{ $apartment->geo_lat}}">
    <input type="hidden" id="lng" value="{{ $apartment->geo_lng}}">

    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
    <script>
        let lat = document.querySelector('#lat').value
        let lng = document.querySelector('#lng').value

        let showMap = L.map('show-map').setView([lat, lng], 13);
        let marker = L.marker([lat, lng]).addTo(showMap);

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiY2FybWlsZW50aXNjbyIsImEiOiJja2NjNnRmYjcwMXMyMnlwdXg0ZDYxM3JwIn0.Zg-CS3Rc5Krle5GllL7reQ', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'your.mapbox.access.token'
        }).addTo(showMap);
    </script>
@endsection