@extends('layouts.app')

@section('content')
    <section class="wrap-search">
            <div class="container-x">
                <div class="desktop-size-search">
                    <div class="container">
                        <div class="search-bar-container">
                            <input type="search" id="search" class="form-control" placeholder="Inserisi l'indirizzo!" name="address" value="{{ old('address') }}" />
                        </div>
                    </div>
                
                    <div class="filter-menu">
                        <div id="filterTitle" class="filter-title">
                            <div class="container">
                                <h5>Applica Filtri</h5><i id="filterShowButtonIcon" class="fas fa-plus-circle"></i>
                            </div>
                        </div>
                        <div id="dropDownFilter" class="dropdown-filter">
                            <div class="container">
                                <div class="dropdown-filter-service">
                                    <h4 class="service-desktop-title">Servizi</h4>
                                    <div class="service-container">
                                        <div class="double-service">
                                            <div>
                                                <input type="checkbox" name="wifi" id="wifi" value="0">
                                                <label for="wifi">Wi-fi</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="posto_macchina" id="posto_macchina" value="0">
                                                <label for="posto_macchina">Posto macchina</label>
                                            </div>
                                        </div>
                                        <div class="double-service">
                                            <div>
                                                <input type="checkbox" name="piscina" id="piscina" value="0">
                                                <label for="piscina">Piscina</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="portineria" id="portineria" value="0">
                                                <label for="portineria">Portineria</label>
                                            </div>
                                        </div>
                                        <div class="double-service">
                                            <div>
                                                <input type="checkbox" name="sauna" id="sauna" value="0">
                                                <label for="sauna">Sauna</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="vista_mare" id="vista_mare" value="0">
                                                <label for="vista_mare">Vista mare</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slider-container container">
                                    <input type="range" class="slider-search " min="1" max="50" value="20" id="myRange">
                                    <p>Km: <span id="show-km"></span></p>
                                </div>
                                <div>
                                   
                                </div>
                
                                <div class="input-number">
                                    <div class="container">
                                        <div class="form-group">
                                            <input id="rooms_number_min" class="form-control" placeholder="n° minimo di stanze" type="number"  name="rooms_number_min">
                                        </div>
                                        <div class="form-group">
                                            <input id="beds_number_min" placeholder="n° minimo di letti" class="form-control" type="number"  name="beds_number_min">
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-container">
                                    <a id="button-search" >Cerca</a>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div id="search-map" class="rounded-lg desktop-map"></div>
                </div>         
                
                <div class="desktop-search-result">
                    <div class="container result-name">
                        <h2>Risultati per : <span id="searchResultName"></span></h2>
                    </div>
        
                    <div class="container apartment-container">
                        <div id="apartment-list"></div>
                    </div>
                    <div id="search-map-mobile" class="rounded-lg search-map"></div>
                </div> 
            </div>
    </section>

    @include('shared.handlebars.template-card-home')

    <script src="{{ asset('js/search.js') }}"></script>

@endsection