@extends('layouts.app')

@section('content')
    <div class="wrapper-guest">
        <div class="layover"></div>
        {{-- Titolo pagina + Search Bar --}}
    <div class="container">
        <div class="title-guest">
            <h1>Benvenuto in {{ $country }}</h1>
            <h2>Uno degli stati più belli del mondo</h2>
        </div>
        {{-- Search bar --}}
        <div class="algolia-search mb-5 mt-4">
            <form action="{{ route('search') }}" method="GET">
                @csrf
                @method('GET')
                <div class="form-group">
                    {{-- <i class="fas fa-search position-absolute"></> --}}
                    <input type="search" id="search" class="form-control" placeholder="Inserisci l'indirizzo" name="address" value="{{ old('address') }}" />
                    <input type="hidden" id="geo_lat" name="geo_lat" value="">
                    <input type="hidden" id="geo_lng" name="geo_lng" value="">
                </div>
            </form>
        </div>
        {{-- Apartments --}}
        <div class="apartments-list-guest">
            @foreach ( $apartments as $apartment )
            <a href="{{ route('apartments.show', $apartment)}}">
                <div class="box-guest">
                    @foreach ($apartment->sponsor_plans as $plan)
                        @if ($plan->sponsorships->deadline > $now)
                            <h4 class="position-absolute">
                                <span class="plate-guest p-2 m-2">Sponsorizzato</span>
                            </h4>
                        @break
                        @endif
                    @endforeach
                    <img class="box-guest-img" src="{{ strpos($apartment->featured_img, '://') ? $apartment->featured_img : asset("/storage/" . $apartment->featured_img  ) }}" alt="Card image cap">
                    <div class="box-guest-body">
                        <h5 class="box-guest-title">{{ substr($apartment->title, 0,  27) }}{{(strlen($apartment->title) >= 27) ? '...' : ''}}</h5>
                        <h6 class="box-guest-text">{{ $apartment->city . ', ' . $apartment->region}}</h6>
                        <?php
                        // Reviews average
                        $numreviews = 0;
                        $rating = 0;
                        $numvotes = 0;
                        foreach ($apartment->reviews as $review) {
                            $numreviews++;  
                            $numvotes++;
                            $rating += $review->rating;
                        }
                        if ($numvotes != 0) {
                            $fullaverage = $rating / $numvotes;
                            $average = round($fullaverage, 2);
                            echo '<h6 class="box-guest-text"><i class="fas fa-star"></i> ';
                            echo $average;
                            echo '/5';
                            echo " ($numreviews";
                            if ($numreviews == 1) {
                                echo ' recensione)';
                            }
                            else {
                                echo ' recensioni)';
                            }
                            echo '</h6>';
                        }
                        elseif ($numvotes == 0) {
                            $fullaverage = 0;
                            $average = 0;
                            echo '<h6 class="box-guest-text">';
                            echo "($numreviews recensioni)</h6>";
                        }
                        ?>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div class="button-guest">
            <a href="{{ route('register') }}">Diventa Host</a>
        </div>
    </div>

    @include('shared.handlebars.template-card-home')

    <script src="{{ asset('js/home.js') }}"></script>
    
@endsection