@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form-group mb-5">
            <label for="search">Indirizzo</label>
            <input type="search" id="search" class="form-control" placeholder="Inserisci l'indirizzo" name="address" value="{{ old('address') }}" />
        </div>
    </div>

    <div class="container">
        <div id="apartment-list"></div>
    </div>

    @include('shared.handlebars.template-card-home')

    <script src="{{ asset('js/search.js') }}"></script>


@endsection