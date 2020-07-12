@extends('layouts.app')

@section('content')
<div class="container">

        {{-- apartment details --}}
        <div class="card mt-4 details-apartment">
            <div class="card-header">
                <strong>Dettagli</strong>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Titolo: {{ $apartment->title }}</li>
                <li class="list-group-item">Decsrizione: {{ $apartment->description }}</li>
                <li class="list-group-item">Numero stanze: {{ $apartment->rooms_number }}</li>
                <li class="list-group-item">Numero letti: {{ $apartment->beds_number }}</li>
                <li class="list-group-item">Numero bagni: {{ $apartment->bathrooms_number }}</li>
                <li class="list-group-item">Metri quadrati: {{ $apartment->square_meters }}</li>
                <li class="list-group-item">Indirizzo: {{ $apartment->address }}</li>
            </ul>
        </div>

        {{-- services --}}
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

    {{-- <!--Carousel--> --}}
    <div class="bd-example">
        <div id="carousel" class="carousel slide" data-ride="carousel">

            {{-- <!--indicators--> --}}
            <ol class="carousel-indicators">
                @foreach($apartment->media as $item)
                <li data-target="#carousel" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                @endforeach
            </ol>

            {{-- <!--carousel img--> --}}
            <div class="carousel-inner">
                @foreach( $apartment->media as $item)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ $item->path }}" class="d-block w-100" alt="{{$item->type}}">
                </div>
                @endforeach
            </div>

            {{-- <!--controller--> --}}
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
    {{-- <!-- End Carousel--> --}}

    {{-- reviews --}}
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

    {{-- info request --}}
    <div class="d-flex justify-center">
        <h3>fai una richiesta</h3>
    </div>

    <form action="{{ route('info.send')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')

        {{-- email --}}
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" placeholder="Inserisci la tua email">
        </div>
        {{-- titolo --}}
        <div class="form-group">
            <label for="title">Titolo</label>
            <input id="title" type="text" name="title" placeholder="Inserisci un titolo">
        </div>
        {{-- descrizione --}}
        <div class="form-group">
            <label for="body">Body</label>
            <textarea class="form-control" name="body" id="body" placeholder="Inserisci una descrizione"></textarea>
        </div>
        
        <input type="submit" value="Invia" class="btn btn-success">
    </form>

</div>
@endsection