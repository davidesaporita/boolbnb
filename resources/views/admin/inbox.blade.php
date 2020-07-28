@extends('layouts.app')

@section('content')

<div class="container mb-5">
<div class="mt-4 info-requests">
    <h4>Richieste di informazioni:</h4>
    <div class="row">

        <table class="table table-light">
            <thead class="thead-light">
              <tr>
                <th scope="col">Email Utente</th>
                <th scope="col">Titolo</th>
                <th scope="col">Testo</th>
                <th scope="col">Visualizzato</th>
                <th scope="col">Azioni</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                <tr>
                <th scope="row">{{ $message->email}} <br>{{ $message->created_at}}</th>
                    <td>{{ $message->title}}</td>
                    <td>{{ $message->body}}</td>
                    <td>{{ $message->read}}</td>
                    <td>
                      <a class="btn btn-success" href="#" role="button">Verifica</a>
                      <br>
                      <a class="btn btn-danger" href="#" role="button">Elimina</a>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>

    </div>
</div>

</div>


@endsection