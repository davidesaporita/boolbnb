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
          
            <div class="mb-4 col-12 col-lg-6 mb-4">
                <h5>Ricevuta da: <a href="mailto://">mail@mail</a></h5>
                <small class="d-block mb-2">Creato il</small>
                <h6><strong>Titolo messaggio</strong></h6>
                <a href="#" class="btn btn-sm btn-primary">Archivia</a>
            </div>

            <div class="mb-4 col-12 col-lg-6 mb-4">
                <p>Non ci sono messaggi!</p>
            </div>

    </div>
</div>

</div>


@endsection