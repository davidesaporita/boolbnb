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
          <a href="#">
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
            <i class="fas fa-star"></i> {{ $average_rating }}/5 ({{ $total_reviews_number }} recensioni)
          </li>
        </ul>
      </div>
    </div>
    {{-- CARDS --}}
    <div class="option-card">
      <a href="#">
        <span>Messaggi</span>
      </a>
      <a href="#">
        <span>Messaggi</span>
      </a>
      <a href="#">
        <span>Messaggi</span>
      </a>
      <a href="#alloggi">
        <span>I tuoi alloggi</span>
      </a>
    </div>
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
                                            {{-- @foreach ($apartment->sponsor_plans as $plan)
                                                @if ($plan->sponsorships->deadline > $now)
                                                    <div class="plate-guest">
                                                        <span>Special Host</span>
                                                    </div>
                                                @break
                                                @endif
                                            @endforeach --}}
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
      </div>
</div>


@endsection