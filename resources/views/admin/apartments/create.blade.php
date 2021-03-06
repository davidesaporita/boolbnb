@extends('layouts.app')

@section('content')
    <section class="create-jumbotron">
        <h1>Crea un alloggio</h1>
    </section>

    <section class="create-page">
        <div class="container">

            <h2 class="title-page">Aggiungi Alloggio</h2>
    
            @if ($errors->all())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    
            <section class="form-card">
                <form id="create-form" action="{{ route('admin.apartments.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    {{-- Descrizione --}}
                    <section class="desktop-card">
                        <section class="apartment-description">
                            <div class="description-sx">
                                    <h3 class="subtitle-size">Descrizione</h3>
                                    <input id="title" class="form-control" type="text" name="title" placeholder="Nome appartamento" maxlength="80" minlength="3" value="{{ old('title') }}" required>
                                    <select class="form-control" name="category_id" id="category">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <textarea class="form-control" name="description" id="description" placeholder="Inserisci una descrizione" maxlength="1000" minlength="10" required>{{ old('description') }}</textarea>
                            </div>
                            <div class="description-dx">
                                <input id="rooms_number" class="form-control" type="number" name="rooms_number" placeholder="n° stanze" value="{{ old('rooms_number') }}" min="1" max="50" required>
                                <input id="beds_number" class="form-control" type="number" name="beds_number" placeholder="n° letti" value="{{ old('beds_number') }}" min="1" max="50" required>
                                <input id="bathrooms_number" class="form-control" type="number" name="bathrooms_number" placeholder="n° bagni" value="{{ old('bathrooms_number') }}" min="1" max="50" required>
                                <input id="square_meters" class="form-control" type="number" name="square_meters" placeholder="n° metri quadrati" value="{{ old('square_meters') }}" min="1" max="1000" required>
    
                                <section class="apartment-service"> 
                                    <h3 class="subtitle-size">Servizi</h3>                  
                                    @foreach ($services as $service)                           
                                        <div>
                                            <input class="form-group radio" type="checkbox" name="services[]" id="service-{{ $loop->iteration }}" value="{{ $service->id }}" {{ old('services[]') == $service->id ? 'checked' : '' }}>
                                            <label for="service-{{ $loop->iteration }}">{{ $service->name }}</label>
                                        </div>
                                    @endforeach
                                </section>
                            </div>
                        </section>
    
                        <section class="apartment-location">
                            <h3 class="subtitle-size">Località</h3>
                            <input type="search" id="search" class="form-control-file" placeholder="Inserisci l'indirizzo" name="address" value="{{ old('address') }}"  required/>
                            <div id="create-map" class="create-map"></div>
                        </section>
                    </section>

                    
                    <section class="apartment-image">                
                        <div>
                            <h3 class="subtitle-size">Immagine principale</h3>
                            <input type="file" id="featured_img" class="form-control-file" name="featured_img"  accept="image/*" required value="{{ old('featured_img') }}">     
                        </div>                            
                        <div>
                            <h3 class="subtitle-size">Immagini secondarie</h3>
                            <input id="secondary_img" type="file" name="media[]" accept="image/*" multiple>
                        </div>
                    </section>

                    <input type="hidden" name="province" id="province" value="{{ old('province') }}">
                    <input type="hidden" name="country" id="country" value="{{ old('country') }}">
                    <input type="hidden" name="geo_lat" id="geo_lat" value="{{ old('geo_lat') }}">
                    <input type="hidden" name="geo_lng" id="geo_lng" value="{{ old('geo_lng') }}">
                    <input type="hidden" id="city" class="form-control" name="city" value="{{ old('city') }}">
                    <input type="hidden" id="region" class="form-control" name="region" value="{{ old('region') }}">
                    <input type="hidden" id="zip_code" class="form-control" name="zip_code" value="{{ old('zip_code') }}">

                    <section class="submit-container">
                        <input type="submit" value="Crea alloggio">
                    </section>
                </form>
            </section>
    
        </div>
    </section>

    <script src="{{ asset('js/map/create-map.js') }}"></script>
@endsection