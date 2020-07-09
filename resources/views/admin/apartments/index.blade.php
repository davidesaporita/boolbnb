@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-column justify-center">
        
        <h1 class="mb-5">Tutti gli appartamenti</h1>

        @if (session('apartment-delete'))
            <div class="card text-white bg-success mb-3" style="width: 100%;">
                <div class="card-header">Elimanto !</div>
                <div class="card-body">
                <h5 class="card-title">{{ session('apartment-delete') }} è stato eliminato.</h5>
                </div>
            </div>
        @endif

        <div class="apartments-list" >
            <table class="table">
                <thead>
                    <tr>
                        <th>NOME APPARTAMENTO</th>
                        <th colspan="3">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $apartments as $apartment )
                        <tr>
                            <th>{{ $apartment->title }}</th>
                            <td><a href="{{ route('admin.apartments.show', $apartment->id) }}" class="btn btn-dark">Mostra</a></td>
                            <td><a href="{{ route('admin.apartments.edit', $apartment->id) }}" class="btn btn-dark">Modifica</a></td>
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