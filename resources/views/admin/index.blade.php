@extends('layouts.app')

@section('content')

<div class="container">
    <div class="dashboard-admin">
        {{-- JUMBOTRON --}}
        <div class="jumbotron-dashboard">
            <div class="jum-dash-title">
                <h1>Bentornat{{(Auth::user()->gender == 'm' ? 'o' : 'a')}} {{Auth::user()->first_name}}</h1>
                <p>E' un piacere ritrovarti. Ecco cosè successo dalla tua ultima visita</p>
            </div>
            <div class="message-info">
                <div class="new-message">
                    @if ($unread_messages_number > 0)
                        <p> Hai {{ $unread_messages_number }} messaggi non letti!</p>            
                    @else
                        <p>Non hai nuovi messaggi!</p>
                    @endif
                </div>
                <div class="button-message">
                    <a href="{{ route('admin.inbox') }}">
                        <span>Leggi Messaggi</span>
                    </a>
                </div>
            </div>
            <div class="icon-info">
                <ul>
                    <li>
                        <i class="fas fa-globe-europe"></i> {{ $total_views_number }} visite
                    </li>
                    <li>
                        <i class="fas fa-inbox"></i> {{ $unread_messages_number }} messaggi
                    </li>
                    <li>
                        <i class="fas fa-pen"></i></i> {{ $total_reviews_number }} recensioni
                    </li>
                    <li>
                        <i class="fas fa-star"></i> {{ $average_rating }}/5 (voto medio)
                    </li>
                </ul>
            </div>
        </div>
        {{-- CARDS --}}
        {{-- <div class="option-card">
            <a href="#">
                <span>Messaggi</span>
            </a>
            <a href="#">
                <span>Messaggi</span>
            </a>
            <a href="{{route('admin.apartments.create')}}">
                <span>Aggiungi alloggio</span>
            </a>
            <a href="#alloggi">
                <span>I tuoi alloggi</span>
            </a>
        </div> --}}
    </div>

    <a class="your-apartments" name="alloggi">
        <h2>I tuoi alloggi</h2>
    </a>

    <div id="dashboard-carousel" class="wrapper-guest-home">
        <div class="container">
            <!--Carousel Wrapper-->
            <div id="multi-item-example" class="carousel slide carousel-multi-item" data-interval="false">
                <!--Controls-->
                @if(count($apartments) > 4)
                    <div class="controls-top">
                        <a class="btn-floating" href="#multi-item-example" data-slide="prev"><i class="fas fa-chevron-left"></i></a>
                        <a class="btn-floating" href="#multi-item-example" data-slide="next"><i class="fas fa-chevron-right"></i></a>
                    </div>
                @endif
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
                                <div class="col-lg-3">
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
        </div>
        <!--end Carousel Wrapper-->

        {{-- inbox desktop --}}
        <div class="info-requests">
            <a class="your-apartments" name="inbox">
                <h2>Richieste di informazioni</h2>
            </a>
            <div class="row">
                <table class="table">
                    <thead class="thead-container">
                        <tr>
                            <th scope="col">Alloggio</th>
                            <th scope="col">Email Utente</th>
                            <th scope="col">Oggetto</th>
                            <th scope="col">Testo</th>
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-container">
                        @foreach ($messages as $message)
                            <tr class="@if($message->read) read @else unread @endif">
                                <th scope="row">{{ $message->apartment->title }}</th>
                                <td>{{ $message->email}} <br>{{ $message->created_at}}</td>
                                <td>{{ $message->title }}</td>
                                <td>{{ $message->body }}</td>
                                <td class="table-button-align" width="150">
                                    <form action="{{ route('admin.inbox.toggle', $message) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        @if($message->read) 
                                            <button type="submit" class="btn btn-secondary mb-2">
                                                <i class="fas fa-undo"></i>
                                                <span>Primo piano</span>
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-success mb-2">
                                                <i class="fas fa-inbox"></i>
                                                <span>Archivia</span>
                                            </button>
                                        @endif
                                    </form>
                                        
                                    <br>
                                    <form action="{{ route('admin.inbox.destroy', $message) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>Elimina</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- end inbox desktop --}}

        {{-- mobile inbox --}}

        <div class="info-requests-mobile">
            <a class="your-apartments" name="inbox">
                <h2>Richieste di informazioni</h2>
            </a>
            @foreach ($messages as $message)
                <div class="box-requests @if($message->read) read @else unread @endif">
                    <ul class="list-group list-unstyled">
                        <li class="list-item">
                            <h4>{{ $message->apartment->title . ', ' . $message->apartment->city }}</h4>
                        </li>
                        <li class="list-item">
                            Data richiesta: <strong>{{ $message->created_at->diffForHumans() }}</strong>
                        </li>
                        <li class="list-item">
                            Email Utente:
                            <strong>{{ $message->email}}</strong>
                        </li>
                        <li class="list-item">
                            Oggetto:
                            <strong>{{ $message->title}}</strong>
                        </li>
                        <li class="list-item">
                            Testo:
                            {{ $message->body}}
                        </li>
                        <li>
                            <form action="{{ route('admin.inbox.toggle', $message) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                @if($message->read) 
                                    <button type="submit" class="btn btn-secondary mb-2">
                                        <i class="fas fa-undo"></i>
                                        <span>Primo piano</span>
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-success mb-2">
                                        <i class="fas fa-inbox"></i>
                                        <span>Archivia</span>
                                    </button>
                                @endif
                            </form>
                                
                            <form action="{{ route('admin.inbox.destroy', $message) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                    <span>Elimina</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>

        {{-- end mobile inbox --}}

        {{-- reviews desktop --}}

        <div class="reviews-box">
            <a class="your-apartments" name="inbox">
                <h2>Recensioni</h2>
            </a>
            <div class="row">
                <table class="table">
                    <thead class="thead-container">
                        <tr>
                            <th scope="col">Alloggio</th>
                            <th scope="col">Visitatore</th>
                            <th scope="col">Titolo</th>
                            <th scope="col">Testo</th>
                            <th scope="col">Valutazione</th>
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-container">
                        @foreach ($reviews as $review)
                        <tr>
                            <th scope="row">{{ $review->apartment->title. ', ' . $review->apartment->city }}</th>
                            <td>{{ $review->first_name . ' ' . $review->last_name}} <br>{{ $review->created_at->diffForHumans() }}</td>
                            <td>{{ $review->title}}</td>
                            <td>{{ $review->body}}</td>
                            <td>{{ $review->rating}}/5</td>
                            <td width="150">
                                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" href="#" role="button" value="Elimina">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- end reviews desktop --}}

        {{-- reviews box mobile --}}

        <div class="reviews-box-mobile">
            <a class="your-apartments" name="inbox">
                <h2>Recensioni</h2>
            </a>
            @foreach ($reviews as $review)
            <div class="box-reviews">
                <ul class="list-group list-unstyled">
                    <li class="list-item">
                        <h4>{{ $review->apartment->title . ', ' . $review->apartment->city }}</h4>
                    </li>
                    <li class="list-item"> <strong>{{ $review->first_name . ' ' . $review->last_name}}</strong> {{ $review->created_at->diffForHumans()}}</li>
                    <li class="list-item"> <strong>Titolo:</strong> {{ $review->title}}</li>
                    <li class="list-item"> <strong>Testo:</strong> {{ $review->body}}</li>
                    <li class="list-item"> <strong>Rating:</strong> {{ $review->rating}}/5</li>
                    <li>
                        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" href="#" role="button" value="Elimina">
                        </form>
                    </li>
                </ul>
            </div>
            @endforeach
        </div>
        
    </div>
</div>


@endsection