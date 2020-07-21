@extends('layouts.app')

@section('content')
    
    {{-- Titolo pagina + Search Bar --}}
    <div class="container">
        <h1>Homepage</h1>
        {{-- Search bar --}}
        <div class=" mb-5">
            <form action="{{ route('search') }}" method="GET">
                @csrf
                @method('GET')
                
                <div class="form-group">
                    <label for="search">Indirizzo</label>        
                    <input type="search" id="search" class="form-control" placeholder="Inserisci l'indirizzo" name="address" value="{{ old('address') }}" />
                    <input type="hidden" id="geo_lat" name="geo_lat" value="">
                    <input type="hidden" id="geo_lng" name="geo_lng" value="">
                </div>
                
                <input type="submit" value="CERCA">
            </form>
        </div>
    </div>

    {{-- Container Appartamenti--}}
    <div class="container">
        {{-- apartments --}}
        <h2 class="mb-5">Lista appartamenti</h2>
        <div class="apartments-list d-flex flex-wrap justify-content-between" >
            @foreach ( $apartments as $apartment )
                <div class="card mb-5" style="width: 22rem;">
                    <img class="card-img-top" src="{{ strpos($apartment->featured_img, '://') ? $apartment->featured_img : asset("/storage/" . $apartment->featured_img  ) }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $apartment->title }}</h5>
                        <h6 class="card-title">{{ $apartment->city . ', ' . $apartment->region . ', ' . $apartment->province }}</h6>
                        <p class="card-text">{{ $apartment->description }}</p>
                        <p>
                            @forelse ($apartment->services as $service)
                                <span class="badge badge-pill badge-secondary">{{ $service->name }}</span>
                            @empty
                                <span class="badge badge-pill badge-warning">No Service</span>
                            @endforelse
                        </p>
                        <a class="btn btn-primary" href="{{ route('apartments.show', $apartment->id)}}">Show</a>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="wrap-pagination mt-5 d-flex justify-content-center">
            {{ $apartments->links() }}
        </div>
    </div>

    <div id="apartment-list"></div>

    @include('shared.handlebars.template-card-home')

    <script src="{{ asset('js/home.js') }}"></script>
@endsection