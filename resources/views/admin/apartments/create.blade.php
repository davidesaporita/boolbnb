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

        <form action="{{ route('admin.apartments.store')}}" method="post">
            @csrf
            @method('POST')
            {{-- Titolo --}}
            <div class="form-group">
                <label for="title">Nome appartamento</label>
                <input id="title" class="form-control" type="text" name="title" placeholder="Inserisci il nome del appartamento" value="{{ old('title') }}">
            </div>
            {{-- Descrizione --}}
            <div class="form-group">
                <label for="description">Descrizione dell appartamento</label>
                <textarea name="description" id="description" placeholder="Inserisci una descrizione">
                    {{ old('description') }}
                </textarea>
            </div>
            {{-- Numero di stanze --}}
            <div class="form-group">
                <label for="rooms_number">Numero di stanze</label>
                <input id="rooms_number" class="form-control" type="number" name="rooms_number" placeholder="n°" value="{{ old('rooms_number') }}">
            </div>
            {{-- Numero di letti --}}
            <div class="form-group">
                <label for="beds_number">Numero di letti</label>
                <input id="beds_number" class="form-control" type="number" name="beds_number" placeholder="n°" value="{{ old('beds_number') }}">
            </div>
            {{-- Numero di bagni --}}
            <div class="form-group">
                <label for="bathrooms_number">Numero di bagni</label>
                <input id="bathrooms_number" class="form-control" type="number" name="bathrooms_number" placeholder="n°" value="{{ old('bathrooms_number') }}">
            </div>
            {{-- Mq --}}
            <div class="form-group">
                <label for="square_meters">Mq</label>
                <input id="square_meters" class="form-control" type="number" name="square_meters" placeholder="n°" value="{{ old('square_meters') }}">
            </div>
            {{-- Address----------------------------------------------------------------------------- --}}
            <div class="form-group">
                <label for="search"></label>
                <input type="search" id="search" class="form-control" placeholder="Scegli la destinazione?" name="location" value="{{ old('address') }}" />
            </div>
            {{-- ------------------------------------------------------------------------------------ --}}
            {{-- File Immagine principale --}}
            <div class="form-group">
                <label for="featured_img">Immagine principale</label>
                <input type="file" name="featured_img" id="featured_img" accept="image/*">
            </div>
            {{-- File Immagine secondaria --}}
            <div class="form-group">
                <label for="path">Immagini secondarie</label>
                @for ( $i = 0; $i < 5; $i++ )
                    <input type="file" name="path[]" id="path" accept="image/*">
                @endfor
            </div>

            {{-- @foreach ($services as $service) 
            <div class="form-group">
                <input type="checkbox" name="services[]" id="service-{{ $loop->iteration }}" value="{{ $service->id }}">
                <label for="service-{{ $loop->iteration }}">{{ $service->name }}</label>
            </div>
            @endforeach --}}
            <input type="submit" value="Crea" class="btn btn-success">
        </form>
    </div>
@endsection