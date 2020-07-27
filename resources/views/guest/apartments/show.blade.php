@extends('layouts.app')

@section('content')

@if ($errors->all())
    <div class="alert alert-danger alerts-show">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->get('message'))
    <div class="alert alert-success alerts-show">
        {{ session()->get('message') }}
        {{ session()->forget('message') }}
    </div>
@endif

@auth
    <div class="dashboard-show-container">
        <div class="dashboard-show-wrapper container">
            <div class="dashboard-admin dashboard-show">
                <div class="option-card-show">
                    <a href="{{route('admin.apartments.sponsorship.pay', ['apartment' => $apartment])}}">
                        <i class="fas fa-bullhorn"></i>
                        <span>Promuovi l'annuncio</span>
                    </a>
                    <a href="{{ route('admin.apartments.edit', $apartment) }}">
                        <i class="fas fa-edit"></i>
                        <span>Modifica informazioni</span>
                    </a>
                    <a href="{{ route('admin.apartments.stats.index', ['apartment' => $apartment ]) }}"">
                        <i class="fas fa-chart-bar"></i>
                        <span>Visualizza statistiche</span>
                    </a>
                    <a href="{{ route('admin.apartments.create') }}">
                        <i class="fas fa-volume-off"></i>
                        <span>Disattiva annuncio</span>
                    </a>
                    <a href="{{ route('admin.apartments.create') }}">
                        <i class="fas fa-trash-alt"></i>
                        <span>Elimina l'annuncio</span>
                    </a>
                    <a href="{{ route('admin.apartments.create') }}">
                        <i class="fas fa-plus"></i>
                        <span>Aggiungi alloggio</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endauth 


<div class="wrap-content">

    {{-- desktop --}}

    <div class="wrap-img-desktop">
        <div class="container">
            <div class="wrap-img-apartment">
                <div class="wrap-featured-img w-50">
                    @if($sponsored)
                        <div class="plate-guest">
                            <span>Special Host</span>
                        </div>
                    @endif
                    <img src="{{ $apartment->featured_img }}" alt="{{ $apartment->title }}">
                </div>
                <div class="wrap-img w-50">
                    @for ($i = 0; $i < 4; $i ++)
                        <?php $urlImage = $apartment->media[$i]['path'] ?>
                        <img src="{{ strpos($urlImage, '://') ? $urlImage : asset("/storage/" . $urlImage ) }}" alt="">
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <div class="wrap-apartment-desktop">
        <div class="container">
            {{-- Col data apartment --}}
            <div class="col-data-apartment">
                <div class="wrap-card-info">
                    <div class="apartment-card">
                        {{-- apartment title --}}
                        <div class="wrap-title">
                            <h3 class="show-title">{{ $apartment->title}}</h3>
                            <h5>{{ $apartment->city . ', ' . $apartment->region }}</h5>
                        </div>
                        <p>{{ $apartment->description}}</p>
                        {{-- apartments details --}}
                        <div class="details-apartment">
                            <h5>{{ $apartment->rooms_number }} <i class="fas fa-person-booth text-secondary"></i></h5>
                            <h5>{{ $apartment->beds_number }} <i class="fas fa-bed text-secondary"></i></h5>
                            <h5>{{ $apartment->bathrooms_number }} <i class="fas fa-bath text-secondary"></i></h5>
                            <h5>{{ $apartment->square_meters }} mq</h5>
                        </div>
                        {{-- service --}}
                        <div class="wrap-service">
                            @forelse ($apartment->services as $service)
                                <h6 class="service-badge"><i class="@isset($service->icon) {{ $service->icon }} @else {{ "fas fa-plus" }} @endisset"></i>{{$service->name}}</h6>
                            @empty
                                <p>Non ci sono servizi aggiuntivi!</p>
                            @endforelse
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
                                    echo '<h6><i class="fas fa-star"></i> ';
                                    echo $average;
                                    echo '/5 </h6>';
                                    echo " <h6> ($numreviews";
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
                    </div>
                </div>

                <div class="wrap-reviews-desktop">
                    <div class="wrap-reviews">
                        @forelse ($apartment->reviews as $review)
                            <div class="card-reviews">
                                <div class="reviews-title">
                                    <h4>{{$review->title}}</h4>
                                    <h6>{{$review->created_at->format('d/m/Y')}}</h6>
                                </div>
                                <p>{{$review->body}}</p>
                                <div class="reviews-rating">
                                    <h5>{{$review->first_name}} {{$review->last_name}}</h5>
                                    <p>{{$review->rating}}/5 <i class="fas fa-star"></i></p>
                                </div>
                            </div>
                        @empty
                            <p>Nessun ha ancora lasciato una recensione su questo alloggio</p>
                        @endforelse
                    </div>
                </div>

                <div class="wrap-reviews-form">
                    <div class="button-reviews">
                        <button id="btn-reviews-desktop">Lascia una Recensione</button>
                    </div>

                    {{-- box-reviews --}}
                    <div id="box-reviews-desktop" class="reviews-form hidden">
                        <form id="info-request-desktop" action="{{ route('reviews', $apartment->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <h5>Raccontaci la tua esperienza presso {{ $apartment->title }}</h5>

                            <div class="name">
                                {{-- Name --}}
                                <div class="">
                                    <input required class="form-control" id="first_name" type="text" name="first_name" placeholder="Il tuo nome" value="{{ old('first_name') }}">
                                </div>
                                {{-- Last_name --}}
                                <div class="">
                                    <input required class="form-control" id="last_name" type="text" name="last_name" placeholder="Il tuo cognome" value="{{ old('last_name') }}">
                                </div>
                            </div>
                            
                            {{-- titolo --}}
                            <div class="form-group">
                                <input required class="form-control" id="title" type="text" name="title" placeholder="Titolo della recensione" value="{{ old('title') }}">
                            </div>
                            {{-- descrizione --}}
                            <div class="form-group">
                                <textarea  required class="form-control" name="body" id="body" placeholder="Scrivi qui la tua recensione">{{ old('title') }}</textarea>
                            </div>
                            
                            {{-- rating --}}
                            <div class="form-group">
                                <label for="rating">Valutazione</label>
                                <select required class="form-control" name="rating" id="rating">
                                    <option value="1">1 - Pessima</option>
                                    <option value="2">2 - Discreta</option>
                                    <option value="3">3 - Nella Media</option>
                                    <option value="4">4 - Buona</option>
                                    <option value="5" selected>5 - Ottima</option>
                                </select>
                            </div>
                    
                            <input type="submit" value="Invia recensione" class="submit submit-magenta">
                        </form>
                    </div>
                </div>
            </div>
            
            {{-- Col info request --}}
            <div class="col-sticky-form">
                <div class="info-card">
                    <div class="title">
                        <h4>Contatta l'host</h4>
                    </div>
                    <div class="wrap-box-info">
                        <form id="form-request-desktop" action="{{ route('info.send', $apartment->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                    
                            {{-- email --}}
                            <div class="form-group">
                                <input required class="form-control" id="email" type="email" name="email" placeholder="Il tuo indirizzo email" @auth value="{{ old('email', Auth::user()->email) }}" @endauth value="{{ old('email') }}">
                            </div>
                            {{-- titolo --}}
                            <div class="form-group">
                                <input required class="form-control" id="title" type="text" name="title" placeholder="Oggetto della tua richiesta" value="{{ old('title') }}">
                            </div>
                            {{-- descrizione --}}
                            <div class="form-group">
                                <textarea required class="form-control" name="body" id="body" placeholder="Scrivi qui la tua richiesta" rows="5">{{ old('body') }}</textarea>
                            </div>

                            <input type="submit" value="Invia richiesta" class="submit submit-magenta">
                            
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- <!-- End desktop--> --}}

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
                @if($sponsored)
                    <div class="plate-guest">
                        <span>Special Host</span>
                    </div>
                @endif
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
                    {{-- <h3>{{ substr($apartment->title, 0,  22) }}{{(strlen($apartment->title) >= 22) ? '...' : ''}}</h3> --}}
                    <h4 class="show-title">{{ $apartment->title }}</h4>
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
                            echo " <h6> ($numreviews";
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
                            <p>Nessun ha ancora lasciato una recensione su questo alloggio</p>
                        @endforelse

                        <div class="wrap-box-reviews">
                            <div class="button-reviews">
                                <button id="btn-reviews">Lascia una recensione</button>
                            </div>
                            
                            {{-- box-reviews --}}
                            <div id="box-reviews" class="reviews-form box-out hidden">
                                <form id="info-request-mobile" action="{{ route('reviews', $apartment->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    
                                    {{-- Name --}}
                                    <div class="form-group">
                                        <input required class="form-control" id="first_name" type="text" name="first_name" placeholder="Il tuo nome" value="{{ old('first_name') }}">
                                    </div>
                                    {{-- Last_name --}}
                                    <div class="form-group">
                                        <input required class="form-control" id="last_name" type="text" name="last_name" placeholder="Il tuo cognome" value="{{ old('last_name') }}"">
                                    </div>
                                    
                                    {{-- titolo --}}
                                    <div class="form-group">
                                        <input required class="form-control" id="title" type="text" name="title" placeholder="Titolo della recensione" value="{{ old('title') }}"">
                                    </div>
                                    {{-- descrizione --}}
                                    <div class="form-group">
                                        <textarea required class="form-control" name="body" id="body" placeholder="Scrivi qui la tua recensione">{{ old('body') }}</textarea>
                                    </div>
                                    
                                    {{-- rating --}}
                                    <div class="form-group">
                                        <label for="rating">Valutazione</label>
                                        <select required class="form-control" name="rating" id="rating">
                                            <option value="1">1 - Pessima</option>
                                            <option value="2">2 - Discreta</option>
                                            <option value="3">3 - Nella Media</option>
                                            <option value="4">4 - Buona</option>
                                            <option value="5" selected>5 - Ottima</option>
                                        </select>
                                    </div>

                                    <input type="submit" value="Pubblica recensione" class="submit submit-magenta">
                                </form>
                            </div>
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
                <h2>Contatta l'host</h2>
            </div>
            <div class="wrap-box-info">
                <div class="info-form">
                    <form id="form-request-mobile" action="{{ route('info.send', $apartment->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                
                        {{-- email --}}
                        <div class="form-group">
                            <input required class="form-control" id="email" type="email" name="email" placeholder="Inserisci la tua email" @auth value="{{ old('email', Auth::user()->email) }}" @endauth>
                        </div>
                        {{-- titolo --}}
                        <div class="form-group">
                            <input required class="form-control" id="title" type="text" name="title" placeholder="Oggetto della tua richiesta" value="{{ old('title') }}">
                        </div>
                        {{-- descrizione --}}
                        <div class="form-group">
                            <textarea required class="form-control" name="body" id="body" placeholder="Scrivi qui la tua richiesta">{{ old('body') }}</textarea>
                        </div>
    
                        <input type="submit" value="Invia richiesta" class="submit submit-magenta">
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- map --}}
    <div id="show-map" class="mobile-map"></div>
    
</div>{{-- <!-- wrap content--> --}}

{{-- MAP LAT AND LONG --}}
<input type="hidden" id="lat" value="{{$apartment->geo_lat}}">
<input type="hidden" id="lng" value="{{$apartment->geo_lng}}">
{{-- JS map --}}
<script src="{{asset('js/map/map-show.js')}}"></script>
@endsection