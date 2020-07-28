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

      {{-- inbox desktop --}}
      <div class="info-requests">
        <a class="your-apartments" name="inbox">
            <h2>Richieste di informazioni</h2>
        </a>
        <div class="row">
            <table class="table">
                <thead class="thead-container">
                    <tr>
                        <th scope="col">Alloggio</th>
                        <th scope="col">Email Utente</th>
                        <th scope="col">Oggetto</th>
                        <th scope="col">Testo</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody class="tbody-container">
                    @foreach ($messages as $message)
                        <tr class="@if($message->read) read @else unread @endif">
                            <th scope="row">{{ $message->apartment->title }}</th>
                            <td>{{ $message->email}} <br>{{ $message->created_at}}</td>
                            <td>{{ $message->title }}</td>
                            <td>{{ $message->body }}</td>
                            <td class="table-button-align" width="150">
                                <form action="{{ route('admin.inbox.toggle', $message, 'admin.inbox') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    @if($message->read) 
                                        <button type="submit" class="btn btn-secondary mb-2">
                                            <i class="fas fa-undo"></i>
                                            <span>Primo piano</span>
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-success mb-2">
                                            <i class="fas fa-inbox"></i>
                                            <span>Archivia</span>
                                        </button>
                                    @endif
                                </form>
                                    
                                <br>
                                <form action="{{ route('admin.inbox.destroy', $message, 'admin.inbox') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                        <span>Elimina</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- end inbox desktop --}}

    {{-- mobile inbox --}}

    <div class="info-requests-mobile">
        <a class="your-apartments" name="inbox">
            <h2>Richieste di informazioni</h2>
        </a>
        @foreach ($messages as $message)
            <div class="box-requests @if($message->read) read @else unread @endif">
                <ul class="list-group list-unstyled">
                    <li class="list-item">
                        <h4>{{ $message->apartment->title . ', ' . $message->apartment->city }}</h4>
                    </li>
                    <li class="list-item">
                        Data richiesta: <strong>{{ $message->created_at->diffForHumans() }}</strong>
                    </li>
                    <li class="list-item">
                        Email Utente:
                        <strong>{{ $message->email}}</strong>
                    </li>
                    <li class="list-item">
                        Oggetto:
                        <strong>{{ $message->title}}</strong>
                    </li>
                    <li class="list-item">
                        Testo:
                        {{ $message->body}}
                    </li>
                    <li>
                        <form action="{{ route('admin.inbox.toggle', $message) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            @if($message->read) 
                                <button type="submit" class="btn btn-secondary mb-2">
                                    <i class="fas fa-undo"></i>
                                    <span>Primo piano</span>
                                </button>
                            @else
                                <button type="submit" class="btn btn-success mb-2">
                                    <i class="fas fa-inbox"></i>
                                    <span>Archivia</span>
                                </button>
                            @endif
                        </form>
                            
                        <form action="{{ route('admin.inbox.destroy', $message) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                                <span>Elimina</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @endforeach
    </div>

        {{-- <table class="table table-light">
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
          </table> --}}

    </div>
</div>

</div>


@endsection