@extends('layouts.app')

@section('content')
    
    {{-- Titolo pagina + Search Bar --}}
    <div class="container">
        {{-- Search bar --}}
        <div class="algolia-search mb-5">
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
    </div>

    {{-- Container Appartamenti--}}
    <div class="container">
        {{-- apartments --}}
        <div class="apartments-list">
            @foreach ( $apartments as $apartment )
            <a href="{{ route('apartments.show', $apartment->id)}}">
                <div class="box">
                    @foreach ($apartment->sponsor_plans as $plan)
                        @if ($plan->sponsorships->deadline > $now)
                            <h4 class="position-absolute">
                                <span class="plate p-2 m-2">Sponsorizzato</span>
                            </h4>
                        @break
                        @endif
                    @endforeach
                    <img class="box-img" src="{{ strpos($apartment->featured_img, '://') ? $apartment->featured_img : asset("/storage/" . $apartment->featured_img  ) }}" alt="Card image cap">
                    <div class="box-body">
                        <h5 class="box-title">{{ substr($apartment->title, 0,  22) }}...</h5>
                        <h6 class="box-text">{{ $apartment->city . ', ' . $apartment->region}}</h6>
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
                            echo '<h6 class="box-text"><i class="fas fa-star"></i> ';
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
                            echo '<h6 class="box-text">';
                            echo "($numreviews recensioni)</h6>";
                        }
                        ?>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <div id="apartment-list"></div>

    @include('shared.handlebars.template-card-home')

    <script src="{{ asset('js/home.js') }}"></script>
    
@endsection