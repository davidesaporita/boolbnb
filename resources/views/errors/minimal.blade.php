
@extends('layouts.app')

@section('content')
    <div class="wrap-error-404">
        <div class="title-error">
            <h1>Attenzione si è verificato un errore ;)</h1>
        </div>
        <div class="error-container">
            <div class="code">
                @yield('code')
            </div>

            <div class="message" style="padding: 10px;">
                @yield('message')
            </div>

            <a href="{{ url('/') }}">Torna alla Home</a>
        </div>
    </div>
        
@endsection

