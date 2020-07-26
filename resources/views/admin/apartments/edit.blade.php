@extends('layouts.app')

@section('content')
    <section class="edit-jumbotron">
        <h1>Modifica un alloggio</h1>
    </section>

    <section class="edit-page">
        <div class="container">

            <h2 class="title-page">Modifica Alloggio</h2>


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
                <form id="edit-form"  action="{{ route('admin.apartments.update', $apartment->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <section class="desktop-card">
                        <section class="apartment-description">
                            <div class="description-sx">
                                <h3 class="subtitle-size">Descrizione</h3>
                                <input id="title" class="form-control" type="text" name="title" placeholder="Nome appartamento" maxlength="50" minlength="10" value="{{ old('title', $apartment->title) }}" required>
                                <select class="form-control" name="category_id" id="category" value="{{ old('category_id') }}">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <textarea class="form-control" name="description" id="description" placeholder="Inserisci una descrizione" maxlength="200" minlength="10" required>{{ old('description', $apartment->description) }}</textarea>
                            </div>
                            <div class="description-dx">
                                <input id="rooms_number" class="form-control" type="number" name="rooms_number" placeholder="n° stanze" value="{{ old('rooms_number', $apartment->rooms_number) }}" min="1" max="50" required>
                                <input id="beds_number" class="form-control" type="number" name="beds_number" placeholder="n° letti" value="{{ old('beds_number', $apartment->beds_number) }}" min="1" max="50" required>
                                <input id="bathrooms_number" class="form-control" type="number" name="bathrooms_number" placeholder="n° bagni" value="{{ old('bathrooms_number', $apartment->bathrooms_number) }}" min="1" max="50" required>
                                <input id="square_meters" class="form-control" type="number" name="square_meters" placeholder="n° metri quadrati" value="{{ old('square_meters', $apartment->square_meters) }}" min="1" max="1000" required>
        
                                <section class="apartment-service"> 
                                    <h3 class="subtitle-size">Servizi</h3>                  
                                    @foreach ($services as $service)                           
                                        <div>
                                            <input class="form-group radio" type="checkbox" name="services[]" id="service-{{ $loop->iteration }}" value="{{ $service->id }}" @if( $apartment->services->contains($service->id) ) checked @endif>
                                            <label for="service-{{ $loop->iteration }}">{{ $service->name }}</label>
                                        </div>
                                    @endforeach
                                </section>
                            </div>
                        </section>

                        <section class="apartment-location">
                            <h3 class="subtitle-size">Località</h3>
                            <input type="search" id="search" class="form-control-file" placeholder="Inserisci l'indirizzo" name="address" value="{{ old('address',$apartment->address) }}"  required/>
                            <div id="edit-map"></div>
                        </section>
                    </section>

                    <section class="apartment-image">                
                        <div>
                            <h3 class="subtitle-size">Immagine principale</h3>
                            <div class="featured-img-container">
                                @isset($apartment->featured_img)
                                    <img  
                                        src="{{ strpos($apartment->featured_img, '://') ? $apartment->featured_img : asset("/storage/" . $apartment->featured_img  ) }}" 
                                        alt="{{ $apartment->title }}">
                                @endisset  
                                <div class="image-action">
                                    <div class="checkbox-container">
                                        <input type="checkbox" name="feat_img_to_delete" id="feat_img_to_delete" class="form-group " value="1"> 
                                        <label for="feat_img_to_delete">Sostituisci</label>
                                    </div>
                                    <div>
                                        <input  class="form-control-file" type="file" name="featured_img" id="featured_img" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>                            
                        <div class="secondary-img-container">
                            <h3 class="subtitle-size">Immagini secondarie</h3>
                            <div class="secondary-img-desktop">
                                @foreach ($apartment->media as $item)
                                    <div class="secondary-img">
                                        <div>
                                            <img 
                                            src="{{ strpos($item->path, '://') ? $item->path : asset("/storage/" . $item->path  ) }}" 
                                            alt="{{ $item->caption }}">
                                        </div>

                                        <div class="image-action">
                                            <div class="checkbox-container">
                                                <input type="checkbox" name="media_to_delete[]" id="media-{{ $item->id }}" value="{{ $item->id }}" >
                                                <label for="media-{{ $item->id }}">Elimina</label>
                                            </div>
                                            <div>
                                                <input type="file" name="media[]" id="file-{{ $item->id }}" accept="image/*">

                                            </div> 
                                        </div>
                                    </div>
                                 @endforeach
                            </div>
                        </div>
                    </section>

        
                    <input type="hidden" name="province" id="province" value="{{ old('province', $apartment->province) }}">
                    <input type="hidden" name="country" id="country" value="{{ old('country', $apartment->country) }}">
                    <input type="hidden" name="geo_lat" id="geo_lat" value="{{ old('geo_lat', $apartment->geo_lat ) }}">
                    <input type="hidden" name="geo_lng" id="geo_lng" value="{{ old('geo_lng', $apartment->geo_lng )}}">
                    <input type="hidden" name="region" id="region" class="form-control" value="{{ old('region', $apartment->region) }}">
                    <input type="hidden" name="city"  id="city" class="form-control" value="{{ old('city', $apartment->city) }}">
                    <input type="hidden" name="zip_code" id="zip_code" class="form-control" value="{{ old('zip_code', $apartment->zip_code) }}">

{{-- 
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Aggiorna" class="btn btn-success">
                    </div> --}}

                    <section class="submit-container">
                        <a href="#" id="submit-create" onclick="document.getElementById('edit-form').submit()"class="button-submit">Aggiorna</a>
                    </section>
                </form>
            </section>
        </div>
    
    </section>
    
    <script src="{{ asset('js/map/edit-map.js') }}"></script>
@endsection