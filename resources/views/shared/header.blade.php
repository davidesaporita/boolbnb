<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@isset($title) {{ $title }} @else {{ config('app.name', 'BoolBnB') }} @endisset</title>
    {{-- Link --}}
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">      {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1/leaflet.css" />     {{-- Leaflet --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        
        <nav class="main-navbar">
            <div class="container">
                <div class="wrap-nav">
                    <div class="nav-user">
                        <a href="{{ url('/') }}">
                            <img src="{{URL::to('/')}}/img/boolbnb-logo.png" alt="">
                        </a>
                        @guest
                            <div class="nav-action-guest">
                                <a href="{{ route('login') }}">Accedi</a>
                                <a href="{{ route('register') }}">Diventa Host</a>
                            </div>
                        @else
                            <div class="nav-action-admin">
                                <a class="nav-link mobile-user" href="{{ route('admin.index') }}">
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                                </a>
                                <i id="menu-icon" class="menu-icon fas fa-bars"></i>
                            </div>
                        @endguest 
                    </div>
                    @auth
                        <div id="sub-menu" class="menu-large mobile-options">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.index') }}">La tua dashboard</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.apartments.create') }}">Aggiungi un alloggio</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >Logout</a>
                                </li>
                            </ul>
                        </div>
                    @endauth
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>
    
