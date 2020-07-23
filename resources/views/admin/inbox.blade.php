@extends('layouts.app')

@section('content')

<div class="container mb-5">
<div class="mt-4 info-requests">
    <h4>Richieste di informazioni:</h4>
    <div class="row">

        <table class="table table-light">
            <thead class="thead-light">
              <tr>
                <th scope="col">Utente</th>
                <th scope="col">Email</th>
                <th scope="col">Titolo</th>
                <th scope="col">Richiesta</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">"nome utente"</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr>
              <tr>
                <th scope="row">"nome utente"</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
              </tr>
              <tr>
                <th scope="row">"nome utente"</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
              </tr>
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