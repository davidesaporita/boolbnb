@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card mb-3">
        <div class="card-body">
            <h2 class="card-title">{{ $apartment->title }}</h2>
            <h4 class="card-text">{{ $apartment->city . ', ' . $apartment->region . ', ' . $apartment->province }}</h4>
        </div>


        <div class="card-body">
            <img src="{{ strpos($apartment->featured_img, '://') ? $apartment->featured_img : asset("/storage/" . $apartment->featured_img  ) }}" style="width: 100%;" alt="{{ $apartment->title }}">
        </div>

        {{-- <!--Carousel--> --}}
        <div class="card-body" style="width: 100%;">
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
                        <img src="{{ strpos($item->path, '://') ? $item->path : asset("/storage/" . $item->path ) }}" class="d-block w-100" alt="{{$item->caption}}">
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
            <div id="reviews-container">
                @forelse ($apartment->reviews as $review)
                    <h5>{{$review->first_name}} {{$review->last_name}}</h5>
                    <strong>{{$review->title}}</strong>
                    <p>{{$review->body}}</p>
                @empty
                    <p>Nessun cliente ha ancora lasciato una recensione</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- info request --}}
    <div class="d-flex justify-content-center">
        <h2 class="h1-responsive font-weight-bold text-center my-4">Richiedi Informazioni</h2>
    </div>

    <form action="{{ route('info.send', $apartment->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')

        {{-- email --}}
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" id="email" type="email" name="email" placeholder="Inserisci la tua email" @auth value="{{ Auth::user()->email }}" @endauth>
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

    {{-- reviws --}}
    <div class="d-flex justify-content-center">
        <h2 class="h1-responsive font-weight-bold text-center my-4">Invia una recensione</h2>
    </div>

    {{-- <form action="{{ route('reviews', $apartment->id)}}" method="post" enctype="multipart/form-data"> --}}
    <form class="form">
        {{-- Name --}}
        <div class="form-group">
            <input class="form-control" id="first_name" type="text" name="first_name" placeholder="Il tuo nome" value="John">
        </div>
        {{-- Last_name --}}
        <div class="form-group">
            <input class="form-control" id="last_name" type="text" name="last_name" placeholder="Il tuo cognome" value="Doe">
        </div>
        
        {{-- titolo --}}
        <div class="form-group">
            <input class="form-control" id="title" type="text" name="title" placeholder="Aggiungi un titolo accattivante alla tua recensione" value="Exciting title">
        </div>
        {{-- descrizione --}}
        <div class="form-group">
            <textarea class="form-control" name="body" id="body" placeholder="Racconta qui la tua esperienza presso {{ $apartment->title }}">Good experience</textarea>
        </div>

        {{-- rating --}}
        <div class="form-group">
            <label for="rating">Che voto dai a {{ $apartment->title }}?</label>
            <select class="form-control" name="rating" id="rating">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5" selected>5</option>
            </select>
        </div>
        
        <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
        <input type="submit" value="Pubblica recensione" class="btn btn-success" id="send-review">
        
    </form>
</div>

@include('shared.handlebars.template-review-guest')

<script src="{{ asset('js/reviews/reviews.js') }}"></script>

@endsection