@extends('layouts.app')

@section('content')
<div class="wrap-content">
    {{-- <!--Carousel--> --}}
    <div>
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


    <div class="wrap-box">
        <div class="container">
            {{-- title  + city--}}
            <div class="wrap-box-title">
                <div class="wrap-title">
                    <h4>{{ substr($apartment->title, 0,  22) }}{{(strlen($apartment->title) >= 22) ? '...' : ''}}</h4>
                    <h6>{{ $apartment->city . ', ' . $apartment->region }}</h6>
                </div>
                {{-- rating --}}
                <div class="wrap-rating">
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
                            echo '<h4><i class="fas fa-star"></i> ';
                            echo $average;
                            echo '/5 </h4>';
                            echo " <h6> $numreviews";
                            if ($numreviews == 1) {
                                echo ' recensione)';
                            }
                            else {
                                echo ' recensioni';
                            }
                            echo '</h6>';
                        }
                        elseif ($numvotes == 0) {
                            $fullaverage = 0;
                            $average = 0;
                            echo '<h6>';
                            echo "$numreviews recensioni</h6>";
                        }
                    ?>
                </div>
                {{-- <!-- End rating--> --}}
            </div>
        </div>
    </div>

    {{-- map --}}
    <div id="show-map"></div>

    {{-- description box --}}
    <div class="wrap-description-box">
        <div class="wrap-box-click">
            <div class="container">
                <div class="box-title">
                    <h5>Descrizione</h5>
                    <i id="plus-description" class="fas fa-plus-circle"></i>
                </div>
            </div>
        </div>
        <div id="dropdown-description" class="description-dropdown hidden">
            <div class="container">
                <div class="box-details">
                    <p>{{ $apartment->description }}</p>
                    <div class="details-apartment">
                        <h5>{{ $apartment->rooms_number }} <i class="fas fa-person-booth text-secondary"></i></h5>
                        <h5>{{ $apartment->beds_number }} <i class="fas fa-bed text-secondary"></i></h5>
                        <h5>{{ $apartment->bathrooms_number }} <i class="fas fa-bath text-secondary"></i></h5>
                        <h5>{{ $apartment->square_meters }} mq</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <!-- End description--> --}}

    {{-- service box --}}
    <div class="wrap-service-box">
        <div class="wrap-box-click">
            <div class="container">
                <div class="box-title">
                    <h5>Servizi</h5>
                    <i id="plus-service" class="fas fa-plus-circle"></i>
                </div>
            </div>
        </div>
        <div id="dropdown-service" class="service-dropdown hidden">
            <div class="container">
                <div class="box-details">
                    <div class="wrap-service">
                        @forelse ($apartment->services as $service)
                            <h6 class="service-badge"><i class="@isset($service->icon) {{ $service->icon }} @else {{ "fas fa-plus" }} @endisset"></i>{{$service->name}}</h6>
                        @empty
                            <p>Non ci sono servizi aggiuntivi!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <!-- End service box--> --}}

    {{-- reviews box --}}
    <div class="wrap-reviews-box">
        <div class="wrap-box-click">
            <div class="container">
                <div class="box-title">
                    <h5>Recensioni</h5>
                    <i id="plus-reviews" class="fas fa-plus-circle"></i>
                </div>
            </div>
        </div>
        <div id="dropdown-reviews" class="reviews-dropdown hidden">
            <div class="container">
                <div class="box-details">
                    <div class="wrap-reviews">
                        @forelse ($apartment->reviews as $review)
                            <div class="card-reviews">
                                <div class="reviews-title">
                                    <h6>{{$review->title}}</h6>
                                    <h6>{{$review->created_at->format('d/m/Y')}}</h6>
                                </div>
                                <p>{{$review->body}}</p>
                                <div class="reviews-rating">
                                    <p>{{$review->rating}}/5 <i class="fas fa-star"></i></p>
                                    <h5>{{$review->first_name}} {{$review->last_name}}</h5>
                                </div>
                            </div>
                        @empty
                            <p>Non ci sono Recensioni!</p>
                        @endforelse

                        <div class="button-reviews">
                            <button id="btn-reviews">Lascia una Recensione</button>
                        </div>

                        {{-- box-reviews --}}
                        <div id="box-reviews" class="reviews-form box-out hidden">
                            <form action="{{ route('reviews', $apartment->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                        
                                {{-- Name --}}
                                <div class="form-group">
                                    <label for="first_name">Nome</label>
                                    <input class="form-control" id="first_name" type="text" name="first_name" placeholder="Inserisci un nome">
                                </div>
                                {{-- Last_name --}}
                                <div class="form-group">
                                    <label for="last_name">Nome</label>
                                    <input class="form-control" id="last_name" type="text" name="last_name" placeholder="Inserisci un cognome">
                                </div>
                        
                                {{-- titolo --}}
                                <div class="form-group">
                                    <label for="title">Titolo</label>
                                    <input class="form-control" id="title" type="text" name="title" placeholder="Inserisci un titolo">
                                </div>
                                {{-- descrizione --}}
                                <div class="form-group">
                                    <label for="body">Descrizione</label>
                                    <textarea class="form-control" name="body" id="body" placeholder="Inserisci una descrizione"></textarea>
                                </div>
                        
                                {{-- rating --}}
                                <div class="form-group">
                                    <label for="rating">Dai un voto</label>
                                    <select class="form-control" name="rating" id="rating">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                        
                                <input type="submit" value="Invia" class="btn btn-success">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <!-- End reviews box--> --}}

    <div class="wrap-request">
        <div class="container">
            <div class="title">
                <h2>Richiedi Informazioni</h2>
            </div>
            <div class="wrap-box-info">
                <div class="info-form">
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
                </div>
            </div>
        </div>
    </div>

    
    
</div>{{-- <!-- wrap content--> --}}

{{-- MAP LAT AND LONG --}}
<input type="hidden" id="lat" value="{{$apartment->geo_lat}}">
<input type="hidden" id="lng" value="{{$apartment->geo_lng}}">
{{-- JS map --}}
<script src="{{asset('js/map/map-show.js')}}"></script>
@endsection