@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <strong>Dettagli</strong>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Propietario: {{$apartment->user->first_name}} {{$apartment->user->last_name}}</li>
                <li class="list-group-item">Titolo: {{$apartment->title}}</li>
                <li class="list-group-item">Categoria: {{$apartment->category->name}}</li>
                <li class="list-group-item">Decsrizione: {{$apartment->description}}</li>
                <li class="list-group-item">Numero stanze: {{$apartment->rooms_number}}</li>
                <li class="list-group-item">numero letti: {{$apartment->beds_number}}</li>
                <li class="list-group-item">Numero bagni: {{$apartment->bathrooms_number}}</li>
                <li class="list-group-item">Metri quadarti: {{$apartment->square_meters}}</li>
                <li class="list-group-item">Indirizzo: {{$apartment->address}}</li>
            </ul>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                <strong>Media</strong>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($apartment->media as $item)
                    <li class="list-group-item">
                        {{$item->path}}
                        {{-- <img src="{{$item->path}}" alt="{{$item->type}}"> --}}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="mt-4">
            <div>
                <strong>
                    Servizi disponibili
                </strong>
            </div>
            @forelse ($apartment->services as $service)
                <span class="badge badge-pill badge-primary">{{$service->name}}</span>
            @empty
                <p>Non ci sono servizi aggiuntivi per questo !</p>
            @endforelse
        </div>
        <div class="mt-4">
            <a class="btn btn-sm btn-primary" href="{{route('admin.apartments.edit', $apartment->id)}}">Modifica</a>
            <form class="d-inline" action="{{route('admin.apartments.destroy', $apartment->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-sm btn-danger" value="Elimina">
            </form>
        </div>
    </div>
@endsection