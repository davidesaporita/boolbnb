<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
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
                    {{-- Logo --}}
                    <a href="{{ url('/') }}">
                        <img src="{{URL::to('/')}}/img/logo-boolbnb.png" alt="">
                    </a>

                    @guest
                        <div class="nav-action-guest">
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Diventa Host</a>
                        </div>
                    @else
                        {{-- Admin --}}

                        <div class="nav-action-admin">
                            <a class="nav-link mobile-user" data-toggle="dropdown">
                                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                            </a>
                            <i id="menu-icon" class="menu-mobile fas fa-bars"></i>

                            <div class="menu-large">
                                <ul>
                                    <li><a href="{{ route('admin.index') }}">La tua Dashborad</a></li>
                                    <li><a href=""><a href="{{ route('admin.apartments.create') }}">Aggiungi appartamento</a></a></li>
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >Logout</a></li>
                                    <li>
                                        <a class="nav-link desktop-user" data-toggle="dropdown">
                                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                                        </a>
                                    </li>
                                </ul>
                                
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>

                        
                        
                    @endguest
                </div>

                <div id="sub-menu" class="sub-menu hidden">
                    <div>
                        <a href="{{ route('admin.index') }}">La tua Dashborad</a>
                    </div>
                    <div>
                        <a href="{{ route('admin.apartments.create') }}">Aggiungi appartamento</a>
                    </div>
                    <div>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >Logout</a>
                    </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>
    
