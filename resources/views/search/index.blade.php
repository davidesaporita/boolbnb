@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form-group mb-5">
            <label for="search">Indirizzo</label>
            <input type="search" id="search" class="form-control" placeholder="Inserisci l'indirizzo" name="address" value="{{ old('address') }}" />
        </div>
        <div class="d-flex">
            <div class="mr-4">
                <input type="checkbox" name="wifi" id="wifi" value="0">
                <label for="wifi">Wi-fi</label>
            </div>
            <div class="mr-4">
                <input type="checkbox" name="posto_macchina" id="posto_macchina" value="0">
                <label for="posto_macchina">Posto macchina</label>
            </div>
            <div class="mr-4">
                <input type="checkbox" name="piscina" id="piscina" value="0">
                <label for="piscina">Piscina</label>
            </div>
            <div class="mr-4">
                <input type="checkbox" name="portineria" id="portineria" value="0">
                <label for="portineria">Portineria</label>
            </div>
            <div class="mr-4">
                <input type="checkbox" name="sauna" id="sauna" value="0">
                <label for="sauna">Sauna</label>
            </div>
            <div class="mr-4">
                <input type="checkbox" name="vista_mare" id="vista_mare" value="0">
                <label for="vista_mare">Vista mare</label>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div id="search-map" class="rounded-lg" style="height: 300px"></div>
    </div>

    <div class="container">
        <div id="apartment-list" class="d-flex flex-wrap justify-content-around"></div>
    </div>

    @include('shared.handlebars.template-card-home')

    <script src="{{ asset('js/search.js') }}"></script>

@endsection