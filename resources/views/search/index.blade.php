@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form-group mb-5">
            <label for="search">Indirizzo</label>
            <input type="search" id="search" class="form-control" placeholder="Inserisci l'indirizzo" name="address" value="{{ old('address') }}" />
        </div>
    </div>

    <div class="container d-flex flex-column align-items-center">
        <div class="d-flex">
            <div class="mr-2">
                <input type="range" min="1" max="100" value="20" class="slider" id="myRange">
                <p>Km: <span id="show-km"></span></p>
            </div>
            <div class="d-flex">
                <div class="d-flex">
                    <div class="mr-2">
                        <input type="checkbox" name="wifi" id="wifi" value="0">
                        <label for="wifi">Wi-fi</label>
                    </div>
                    <div class="mr-2">
                        <input type="checkbox" name="posto_macchina" id="posto_macchina" value="0">
                        <label for="posto_macchina">Posto macchina</label>
                    </div>
                    <div class="mr-2">
                        <input type="checkbox" name="piscina" id="piscina" value="0">
                        <label for="piscina">Piscina</label>
                    </div>
                    <div class="mr-2">
                        <input type="checkbox" name="portineria" id="portineria" value="0">
                        <label for="portineria">Portineria</label>
                    </div>
                    <div class="mr-2">
                        <input type="checkbox" name="sauna" id="sauna" value="0">
                        <label for="sauna">Sauna</label>
                    </div>
                    <div class="mr-2">
                        <input type="checkbox" name="vista_mare" id="vista_mare" value="0">
                        <label for="vista_mare">Vista mare</label>
                    </div>
                </div>
            </div>
        </div>


        <div class=" container row mb-5">
            <div class="form-group col-6">
                <label for="rooms_number_min">Numero di stanze [ min ]</label>
                <input id="rooms_number_min" class="form-control" type="number"  name="rooms_number_min">
            </div>
            <div class="form-group col-6">
                <label for="beds_number_min">Numero di letti  [ min ]</label>
                <input id="beds_number_min" class="form-control" type="number"  name="beds_number_min">
            </div>
        </div>
        <span id="button-search" class="btn btn-success mb-5">Cerca</span>
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