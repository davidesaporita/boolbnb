@extends('layouts.app')

@section('content')

<div class="container mb-5">
<div class="mt-4 info-requests">
    <h4>Recensioni:</h4>
    <div class="row">

        <table class="table table-light">
            <thead class="thead-light">
              <tr>
                <th scope="col">Visitatore</th>
                <th scope="col">Titolo</th>
                <th scope="col">Testo</th>
                <th scope="col">Valutazione</th>
                <th scope="col">Azioni</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                <tr>
                <th scope="row">{{ $review->first_name . ' ' . $review->last_name}} <br>{{ $review->created_at}}</th>
                    <td>{{ $review->title}}</td>
                    <td>{{ $review->body}}</td>
                    <td>{{ $review->rating}}</td>
                    <td>
                      <a class="btn btn-success" href="#">Verifica</a>
                      <br>
                      <a class="btn btn-danger" href="#">Elimina</a>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>

    </div>
</div>

</div>


@endsection