@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-group mb-5">
        <label for="search">Indirizzo</label>
        <input type="search" id="search" class="form-control" placeholder="Inserisci l'indirizzo" name="address" value="{{ old('address', 'Piazza di Spagna, 1, Roma, Italia') }}" />
    </div>
</div>

<script src="{{ asset('js/home.js') }}"></script>

<div id="hits">
    
</div>

@endsection