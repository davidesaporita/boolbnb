@extends('layouts.app')

@section('content')
    <div class="container">

        <header class="d-flex justify-center">
            <h1>Aggiungi una stanza</h1>
        </header>

        @if ($errors->all())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.apartments.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            {{-- Titolo --}}
            <div class="form-group">
                <label for="title">Nome appartamento</label>
                <input id="title" class="form-control" type="text" name="title" placeholder="Inserisci il nome del appartamento" value="{{ old('title', 'Appartamento power') }}">
            </div>
            {{-- Descrizione --}}
            <div class="form-group">
                <label for="description">Descrizione dell appartamento</label>
                <textarea class="form-control" name="description" id="description" placeholder="Inserisci una descrizione">
                    {{ old('description', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, asperiores odit! Totam optio pariatur eius, ducimus eaque praesentium magni adipisci similique.') }} 
                </textarea>
            </div>
            {{-- Numero di stanze --}}
            <div class="form-group">
                <label for="rooms_number">Numero di stanze</label>
                <input id="rooms_number" class="form-control" type="number" name="rooms_number" placeholder="n°" value="{{ old('rooms_number', '2') }}">
            </div>
            {{-- Numero di letti --}}
            <div class="form-group">
                <label for="beds_number">Numero di letti</label>
                <input id="beds_number" class="form-control" type="number" name="beds_number" placeholder="n°" value="{{ old('beds_number', '3') }}">
            </div>
            {{-- Numero di bagni --}}
            <div class="form-group">
                <label for="bathrooms_number">Numero di bagni</label>
                <input id="bathrooms_number" class="form-control" type="number" name="bathrooms_number" placeholder="n°" value="{{ old('bathrooms_number', '1') }}">
            </div>
            {{-- Mq --}}
            <div class="form-group">
                <label for="square_meters">Mq</label>
                <input id="square_meters" class="form-control" type="number" name="square_meters" placeholder="n°" value="{{ old('square_meters', '80') }}">
            </div>
            {{-- Address----------------------------------------------------------------------------- --}}
            <div class="form-group">
                <label for="search">Indirizzo</label>
                <input type="search" id="search" class="form-control" placeholder="Inserisci l'indirizzo" name="location" value="{{ old('address') }}" />
            </div>
            {{-- Address 2 (regione)----------------------------------------------------------------------------- --}}
            <div class="form-group">
                <label for="address_2">Regione</label>
                <input type="text" id="address_2" class="form-control" name="address_2" />
            </div>
            {{-- Address----------------------------------------------------------------------------- --}}
            <div class="form-group">
                <label for="city">Città</label>
                <input type="text" id="city" class="form-control" name="city" />
            </div>
            {{-- Address----------------------------------------------------------------------------- --}}
            <div class="form-group">
                <label for="zip_code">CAP</label>
                <input type="text" id="zip_code" class="form-control" name="zip_code" />
            </div>
            {{-- ------------------------------------------------------------------------------------ --}}
            {{-- File Immagine principale --}}
            <div class="form-group">
                <label for="featured_img">Immagine principale</label>
                <input  class="form-control-file" type="file" name="featured_img" id="featured_img" accept="image/*">
            </div>
            {{-- File Immagine secondaria --}}
            <h3>Immagini secondarie</h3>
            @for ( $i = 0; $i < 5; $i++ )
                <div class="form-group">
                    <input type="file" name="path[]" id="path" accept="image/*">
                </div>
            @endfor

            @foreach ($services as $service) 
                <div class="form-group">
                    <input type="checkbox" name="services[]" id="service-{{ $loop->iteration }}" value="{{ $service->id }}">
                    <label for="service-{{ $loop->iteration }}">{{ $service->name }}</label>
                </div>
            @endforeach

            <input type="hidden" name="geo_lat" id="geo_lat" value="">
            <input type="hidden" name="geo_lng" id="geo_lng" value="">
            <input type="submit" value="Crea" class="btn btn-success">
        </form>
    </div>
@endsection