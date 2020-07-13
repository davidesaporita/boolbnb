@extends('layouts.app')

@section('content')
<div class="container">

    

    <div class="card mb-3">
        <div class="card-body">
            <h2 class="card-title">{{ $apartment->title }}</h2>
            <h4 class="card-text">{{ $apartment->city . ', ' . $apartment->region . ', ' . $apartment->province }}</h4>
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

        {{-- details apartment --}}
        <div class="card-body">
            <p>{{ $apartment->description }}</p>
            <div class="d-flex align-items-center">
                <h5 class="ml-2"> {{ $apartment->rooms_number }} <i class="fas fa-person-booth text-secondary"></i></h5>
                <h5 class="ml-2">{{ $apartment->beds_number }} <i class="fas fa-bed text-secondary"></i></h5>
                <h5 class="ml-2">{{ $apartment->bathrooms_number }} <i class="fas fa-bath text-secondary"></i></h5>
                <h5 class="ml-2">{{ $apartment->square_meters }} mq</h5>
            </div>
        </div>

        {{-- services --}}
        <div class="card-body">
            <div>
                <strong>Servizi disponibili</strong>
            </div>
            @forelse ($apartment->services as $service)
                <span class="badge badge-pill badge-primary">{{$service->name}}</span>
            @empty
                <p>Non ci sono servizi aggiuntivi!</p>
            @endforelse
        </div>
    </div>

    <div class="card mb-3">
        {{-- reviews --}}
        <div class="card-body">
            <h4>Recensioni</h4>
            @forelse ($apartment->reviews as $review)
                <h5>{{$review->first_name}} {{$review->last_name}}</h5>
                <strong>{{$review->title}}</strong>
                <p>{{$review->body}}</p>
            @empty
                <p>Non ci sono commenti!</p>
            @endforelse
        </div>
    </div>

    {{-- info request --}}
    <div class="d-flex justify-content-center">
        <h2 class="h1-responsive font-weight-bold text-center my-4">Richiedi Informazioni</h2>
    </div>

    <form action="{{ route('info.send')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')

        {{-- email --}}
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" id="email" type="email" name="email" placeholder="Inserisci la tua email">
        </div>
        {{-- titolo --}}
        <div class="form-group">
            <label for="title">Titolo</label>
            <input class="form-control" id="title" type="text" name="title" placeholder="Inserisci un titolo">
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