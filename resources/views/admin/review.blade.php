@extends('layouts.app')

@section('content')

<div class="container mb-5">
<div class="mt-4 info-requests">
    <h4>Recensioni:</h4>
    <div class="row">

        <table class="table table-light">
            <thead class="thead-light">
              <tr>
                <th scope="col">Email Utente</th>
                <th scope="col">Titolo</th>
                <th scope="col">Testo</th>
                <th scope="col">Valutazione</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($review as $review)
                <tr>
                <th scope="row">{{ $review->email}} <br>{{ $review->created_at}}</th>
                    <td>{{ $review->title}}</td>
                    <td>{{ $review->body}}</td>
                    <td>{{ $review->score}}</td>
                  </tr>
                @endforeach
              <tr>
                <th scope="row">    </th>
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

    </div>
</div>

</div>


@endsection