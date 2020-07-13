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

        <form action="{{ route('admin.apartments.update', $apartment->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            {{-- Info Stanza : Titolo / Categorie --}}
            <section class="row mb-2">
                {{-- Titolo --}}
                <div class="form-group col-8">
                    <label for="title">Nome appartamento</label>
                    <input id="title" class="form-control" type="text" name="title" placeholder="Inserisci il nome del appartamento" value="{{ old('title', $apartment->title) }}">
                </div>        
                {{-- Category --}}
                <div class="d-flex flex-column form-group col-4 ">
                    <label for="category">Category</label>
                    <select class="form-control" name="category_id" id="category" value="{{ old('category_id') }}">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </section>
            {{-- Descrizione --}}
            <div class="form-group">
                <label for="description">Descrizione dell appartamento</label>
                <textarea name="description" id="description" class="form-control" placeholder="Inserisci una descrizione">
                    {{ old('description', $apartment->description) }}
                </textarea>
            </div>
            {{-- Info stanza : Numero Stanze / Letti / Bagni / Mq --}}
            <section class="row mb-5">
                {{-- Numero di stanze --}}
                <div class="form-group col-3">
                    <label for="rooms_number">Numero di stanze</label>
                    <input id="rooms_number" class="form-control" type="number" name="rooms_number" placeholder="n°" value="{{ old('rooms_number', $apartment->rooms_number) }}">
                </div>
                {{-- Numero di letti --}}
                <div class="form-group col-3">
                    <label for="beds_number">Numero di letti</label>
                    <input id="beds_number" class="form-control" type="number" name="beds_number" placeholder="n°" value="{{ old('beds_number', $apartment->beds_number) }}">
                </div>
                {{-- Numero di bagni --}}
                <div class="form-group col-3">
                    <label for="bathrooms_number">Numero di bagni</label>
                    <input id="bathrooms_number" class="form-control" type="number" name="bathrooms_number" placeholder="n°" value="{{ old('bathrooms_number', $apartment->bathrooms_number) }}">
                </div>
                {{-- Mq --}}
                <div class="form-group col-3">
                    <label for="square_meters">Mq</label>
                    <input id="square_meters" class="form-control" type="number" name="square_meters" placeholder="n°" value="{{ old('square_meters', $apartment->square_meters) }}">
                </div>
            </section>
            {{-- Indicazioni Geografiche : Via / Regione / Città / Codice Postale --}}
            <section class="row d-flex align-items-center mb-5">
                <div class="col-6">
                    {{-- Via --}}
                    <div class="form-group">
                        <label for="search">Indirizzo</label>
                        <input type="search" id="search" class="form-control" placeholder="Inserisci l'indirizzo" name="address" value="{{ old('address', $apartment->address) }}" />
                    </div>
                    {{-- Regione --}}
                    <div class="form-group">
                        <label for="region">Regione</label>
                        <input type="text" id="region" class="form-control" name="region" />
                    </div>
                    {{-- Città --}}
                    <div class="form-group">
                        <label for="city">Città</label>
                        <input type="text" id="city" class="form-control" name="city" />
                    </div>
                    {{-- ZipCode --}}
                    <div class="form-group">
                        <label for="zip_code">CAP</label>
                        <input type="text" id="zip_code" class="form-control" name="zip_code" />
                    </div>
                </div>

                {{-- Mappa --}}
                <div id="mapid" class="col-6"></div>

            </section>
            {{-- Immagini --}}
            <section class="mb-5">
                {{-- File Immagine principale --}}
                <div class="form-group">
                    <h3>Immagine Principale</h3>
                    @isset($apartment->featured_img)
                        <img class="mb-5 mt-5" height="200px" width="200px" src="{{ asset($apartment->featured_img  ) }}" alt="{{ $apartment->title }}">
                    @endisset
                    <input  class="form-control-file" type="file" name="featured_img" id="featured_img" accept="image/*">
                </div>
                {{-- File Immagine secondaria --}}
                <h3>Immagini secondarie</h3>
                <div class="row">
                    @for ( $i = 0; $i < 5; $i++ )
                        <div class="form-group">
                            <input type="file" name="path[]" id="path" accept="image/*">
                        </div>
                    @endfor
                </div>
            </section>

            <section class="d-flex justify-content-around mb-5">
                @foreach ($services as $service) 
                    <div class="form-group">
                        <input type="checkbox" name="services[]" id="service-{{ $loop->iteration }}"  class="form-check-input" value="{{ $service->id }}" 
                        @if( $apartment->services->contains($service->id) ) checked @endif>
                        <label for="service-{{ $loop->iteration }}">{{ $service->name }}</label>
                    </div>
                @endforeach
            </section>

            <input type="hidden" name="province" id="province" value="">
            <input type="hidden" name="country" id="country" value="">
            <input type="hidden" name="geo_lat" id="geo_lat" value="{{ old('geo_lat', $apartment->geo_lat ) }}">
            <input type="hidden" name="geo_lng" id="geo_lng" value="{{ old('geo_lng', $apartment->geo_lng )}}">
            <div class="d-flex justify-content-end">
                <input type="submit" value="Aggiorna" class="btn btn-success">
            </div>
        </form>
    </div>
@endsection