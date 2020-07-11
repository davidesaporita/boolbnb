@extends('layouts.app')

@section('content')
<div class="container">
        <div class="card mt-4 details-apartment">
            <div class="card-header">
                <strong>Dettagli</strong>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Titolo: {{ $apartment->title }}</li>
                <li class="list-group-item">Decsrizione: {{ $apartment->description }}</li>
                <li class="list-group-item">Numero stanze: {{ $apartment->rooms_number }}</li>
                <li class="list-group-item">Numero letti: {{ $apartment->beds_number }}</li>
                <li class="list-group-item">Numero bagni: {{ $apartment->bathrooms_number }}</li>
                <li class="list-group-item">Metri quadrati: {{ $apartment->square_meters }}</li>
                <li class="list-group-item">Indirizzo: {{ $apartment->address }}</li>
            </ul>
        </div>
@endsection