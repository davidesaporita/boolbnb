@extends('layouts.app')

@section('content')

@if ($errors->all())
    <div class="alert alert-danger alerts-show">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->get('message'))
    <div class="alert alert-success alerts-show">
        {{ session()->get('message') }}
        {{ session()->forget('message') }}
    </div>
@endif

<div class="container">
  <div class="dashboard-admin">
    <div class="row">
    {{-- reviews desktop --}}


    <div class="reviews-box">
      <a class="your-apartments" name="inbox">
          <h2>Recensioni</h2>
      </a>
      <div class="row">
          <table class="table">
              <thead class="thead-container">
                  <tr>
                      <th scope="col">Alloggio</th>
                      <th scope="col">Visitatore</th>
                      <th scope="col">Titolo</th>
                      <th scope="col">Testo</th>
                      <th scope="col">Valutazione</th>
                      <th scope="col">Azioni</th>
                  </tr>
              </thead>
              <tbody class="tbody-container">
                  @foreach ($reviews as $review)
                  <tr>
                      <th scope="row">{{ $review->apartment->title. ', ' . $review->apartment->city }}</th>
                      <td>{{ $review->first_name . ' ' . $review->last_name}} <br>{{ $review->created_at->diffForHumans() }}</td>
                      <td>{{ $review->title}}</td>
                      <td>{{ $review->body}}</td>
                      <td>{{ $review->rating}}/5</td>
                      <td width="150">
                          <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <input type="submit" class="btn btn-danger" href="#" role="button" value="Elimina">
                          </form>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
    </div>
    {{-- end reviews desktop --}}

    {{-- reviews box mobile --}}

    <div class="reviews-box-mobile">
      <a class="your-apartments" name="inbox">
          <h2>Recensioni</h2>
      </a>
      @foreach ($reviews as $review)
        <div class="box-reviews">
            <ul class="list-group list-unstyled">
                <li class="list-item">
                    <h4>{{ $review->apartment->title . ', ' . $review->apartment->city }}</h4>
                </li>
                <li class="list-item"> <strong>{{ $review->first_name . ' ' . $review->last_name}}</strong> {{ $review->created_at->diffForHumans()}}</li>
                <li class="list-item"> <strong>Titolo:</strong> {{ $review->title}}</li>
                <li class="list-item"> <strong>Testo:</strong> {{ $review->body}}</li>
                <li class="list-item"> <strong>Rating:</strong> {{ $review->rating}}/5</li>
                <li>
                    <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" href="#" role="button" value="Elimina">
                    </form>
                </li>
            </ul>
        </div>
      @endforeach

    </div>
  </div>
</div>


@endsection