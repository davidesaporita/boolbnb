@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-4 details-apartment">
        <div class="card-header bg-white">
            <h1 class="card-text">{{$apartment->title}}</h1>
            <h2 class="card-text">{{ $apartment->city . ', ' . $apartment->region . ', ' . $apartment->province }}</h2>
        </div>
        <img class="w-100" src="{{ strpos($apartment->featured_img, '://') ? $apartment->featured_img : asset("/storage/" . $apartment->featured_img  ) }}" alt="{{$apartment->title}}">
        <div class="card-body">
            <p class="card-title">
                Propietario: <strong>{{$apartment->user->first_name}} {{$apartment->user->last_name}}</strong>
            </p>
            <p class="card-text">{{$apartment->category->name}}</p>
            <p class="card-text">{{$apartment->address}}</p>
            <p class="card-text">{{$apartment->description}}</p>
            <div class="d-flex align-items-center">
                <h5 class="ml-2"> {{ $apartment->rooms_number }} <i class="fas fa-person-booth text-secondary"></i></h5>
                <h5 class="ml-2">{{ $apartment->beds_number }} <i class="fas fa-bed text-secondary"></i></h5>
                <h5 class="ml-2">{{ $apartment->bathrooms_number }} <i class="fas fa-bath text-secondary"></i></h5>
                <h5 class="ml-2">{{ $apartment->square_meters }} m²</h5>
            </div>    
            <div class="mt-4 services-apartment">
                <div class="mb-2">
                    <strong>Servizi disponibili</strong>
                </div>
                <div class="d-flex flex-column align-items-start">
                    @forelse ($apartment->services as $service)
                        <span class="badge badge-pill badge-primary mb-2">{{$service->name}}</span>
                    @empty
                        <p>Non ci sono servizi aggiuntivi!</p>
                    @endforelse
                </div>
            </div>        
        </div>
    </div>
    <div class="card mt-4 media-apartment">
        <div class="card-header">
            <strong>Altre immagini</strong>
        </div>
        <div class="card-body">
            <div id="carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach($apartment->media as $item)
                        <li data-target="#carousel" data-slide-to="{{$loop->index}}" class="{{$loop->first ? 'active' : ''}}"></li>
                    @endforeach
                </ol>    
                <div class="carousel-inner">
                    @foreach ($apartment->media as $item)
                        <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                            <img src="{{ strpos($item->path, '://') ? $item->path : asset("/storage/" . $item->path ) }}" class="d-block w-100" alt="{{$item->caption}}">
                        </div>
                    @endforeach
                </div>
            </div>
            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="mt-4 button-options">
        <a class="btn btn-sm btn-primary" href="{{route('admin.apartments.edit', $apartment->id)}}">Modifica</a>
        <form class="d-inline" action="{{route('admin.apartments.destroy', $apartment->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-sm btn-danger" value="Elimina">
        </form>
    </div>
    <div class="card bg-dark text-white mt-4">
        <div class="mt-3 mb-3 sponsor-plan text-center">
            <h4 class="mb-3">Piano sponsorizzazione</h4>
            @forelse ($apartment->sponsor_plans as $plan)
                @if ($plan->sponsorships->deadline > $now)
                    <span class="p-2 pr-4 pl-4 rounded bg-light text-dark">{{$plan->name}}</span>
                    <p class="mt-4">Durata sponsorizzazione: {{$plan->hours}} ore</p>
                    <p class="text-warning">Termine della sponsorizzazione: {{$plan->sponsorships->deadline}}</p>
                    @break
                @elseif ($loop->last)
                    <p>Non ci sono sponsorizzazioni!</p>
                    <a class="btn btn-sm btn-light" href="{{ route('admin.apartments.sponsorship.pay', ['apartment' => $apartment ]) }}">Nuovo Sponsor</a>
                @endif
            @empty
                <p>Non ci sono sponsorizzazioni!</p>
                <a class="btn btn-sm btn-light" href="{{ route('admin.apartments.sponsorship.pay', ['apartment' => $apartment ]) }}">Nuovo Sponsor</a>
            @endforelse
        </div>
        
        <div class="mt-4 sponsor-plan">
            <h2>Guarda le stat sull'appartamento</h2>
            <a class="btn btn-sm btn-dark" href="{{ route('admin.apartments.stats.index', ['apartment' => $apartment ]) }}">Statistiche</a>
        </div>

        <div id="show-map" style="height: 300px"></div>

    </div>

    <div class="mt-4 info-requests">
        <h4>Richieste di informazioni:</h4>
        @forelse ($apartment->info_requests as $request)
            <h5>Ricevuta da: <a href="mailto:{{$request->email}}">{{$request->email}}</a></h5>
            <h6>{{$request->title}}</h6>
            <p>{{$request->body}}</p>
            <p>{{$request->created_at}}</p>
            <a class="btn btn-sm btn-danger mb-4" href="#">Elimina</a>
        @empty
            <p>Non ci sono commenti!</p>
        @endforelse
    </div>
    
    <div class="comments">
        <h4>Commenti:</h4>
        @forelse ($apartment->reviews as $review)
            <h5>{{$review->first_name}} {{$review->last_name}}</h5>
            <strong>{{$review->title}}</strong>
            <p>{{$review->body}}</p>
            <p>{{$review->created_at}}</p>
        @empty
            <p>Non ci sono commenti!</p>
        @endforelse
    </div>
</div>

<input type="hidden" id="lat" value="{{ $apartment->geo_lat}}">
<input type="hidden" id="lng" value="{{ $apartment->geo_lng}}">

<script src="{{ asset('js/map/map-show.js')}}"></script>

@endsection