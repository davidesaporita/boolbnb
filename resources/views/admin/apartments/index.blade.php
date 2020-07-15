@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-column justify-center">
        
        <h1 class="mb-5">Tutti gli appartamenti</h1>

        @if (session('deleted_apartment'))
            <div class="card text-white bg-success mb-3" style="width: 100%;">
                <div class="card-header">Elimanto !</div>
                <div class="card-body">
                <h5 class="card-title">{{ session('deleted_apartment') }} è stato eliminato.</h5>
                </div>
            </div>
        @endif

        <div class="apartments-list" >
            <table class="table">
                <thead>
                    <tr>
                        <th>NOME APPARTAMENTO</th>
                        <th colspan="4">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $apartments as $apartment )
                        <tr>
                            <th>{{ $apartment->title }}</th>
                            <td><a href="{{ route('admin.apartments.show', $apartment->id) }}" class="btn btn-primary">Mostra</a></td>
                            <td><a href="{{ route('admin.apartments.edit', $apartment->id) }}" class="btn btn-primary">Modifica</a></td>
                                <td>
                                <form action="{{ route('admin.apartments.toggle', $apartment->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    @if($apartment->active == 1)
                                        <input type="submit" class="btn btn-dark" value="Disabilita">
                                    @else 
                                        <input type="submit" class="btn btn-success" value="Abilita">
                                    @endif
                                </form>
                            </td>  
                            <td>
                                <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-danger" type="submit" value="Elimina">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="wrap-pagination mt-5 d-flex justify-content-center">
            {{ $apartments->links() }}
        </div>
    </div>
@endsection