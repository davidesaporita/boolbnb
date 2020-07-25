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
        <span>Leggi Messaggi</span>
      </a>
      <a href="#">
        <span>Leggi Messaggi</span>
      </a>
      <a href="#">
        <span>Leggi Messaggi</span>
      </a>
      <a href="#">
        <span>Leggi Messaggi</span>
      </a>
    </div>
  </div>
</div>

@endsection