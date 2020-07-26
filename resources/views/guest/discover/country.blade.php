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
            <div class="algolia-search">
                <form action="{{ route('search') }}" method="GET">
                    @csrf
                    @method('GET')
                    <div class="form-group">
                        {{-- <i class="fas fa-search"></i> --}}
                        <input type="search" id="search" class="form-control" placeholder="Inserisci un indirizzo" name="address" value="{{ old('address') }}" />
                        <div class="algolia-button-search">
                            <a href="#">Cerca</a>
                        </div>            
                        <input type="hidden" id="geo_lat" name="geo_lat" value="">
                        <input type="hidden" id="geo_lng" name="geo_lng" value="">
                    </div>
                </form>
            </div>
            <!--Carousel Wrapper-->
            <div id="multi-item-example" class="carousel slide carousel-multi-item" data-interval="false">
                <!--Controls-->
                <div class="controls-top">
                    <a class="btn-floating" href="#multi-item-example" data-slide="prev"><i class="fas fa-chevron-left"></i></a>
                    <a class="btn-floating" href="#multi-item-example" data-slide="next"><i class="fas fa-chevron-right"></i></a>
                </div>
                <!--Indicators-->
                <ol class="carousel-indicators">
                    @foreach ($apartments as $apartment)
                        @if (($loop->iteration % 4) == 0)
                            <li data-target="#multi-item-example" data-slide-to="{{(($loop->iteration % 4) == 0)}}" class="active"></li>
                        @endif
                    @endforeach
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="apartments-list-guest">
                        {{-- Apartments --}}
                        @foreach ($apartments as $apartment)
                            @if ($loop->first)
                                <div class="carousel-item carousel-custom active">  
                            @elseif ((($loop->iteration - 1) % 4) == 0)
                                <div class="carousel-item carousel-custom">
                            @endif
                                <div class="col-md-3">
                                    <a href="{{ route('apartments.show', $apartment)}}">
                                        <div class="box-guest">
                                            @foreach ($apartment->sponsor_plans as $plan)
                                                @if ($plan->sponsorships->deadline > $now)
                                                    <div class="plate-guest">
                                                        <span>Special Host</span>
                                                    </div>
                                                @break
                                                @endif
                                            @endforeach
                                            <img class="box-guest-img" src="{{ strpos($apartment->featured_img, '://') ? $apartment->featured_img : asset("/storage/" . $apartment->featured_img  ) }}" alt="Card image cap">
                                            <div class="box-guest-body">
                                                <h5 class="box-guest-title">{{ substr($apartment->title, 0, 25) }}{{(strlen($apartment->title) >= 25) ? '...' : ''}}</h5>
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
                                </div>
                                @if (($loop->iteration % 4) == 0)
                                    </div>
                                @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="button-guest">
                <a href="{{ route('register') }}">Diventa Host</a>
            </div>
        </div>
    </div>

    @include('shared.handlebars.template-card-home')

    <script src="{{ asset('js/home.js') }}"></script>
    
@endsection