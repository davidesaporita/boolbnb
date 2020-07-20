@extends('layouts.app')

@section('content')
<div class="container d-flex flex-wrap justify-content-center">
    <div class="mb-3 d-flex flex-wrap justify-content-around w-100">
        <h3>Messaggi ricevuti: {{$numrequests}}</h3>
        @if ($numvotes == 0)
            <h3>Non ci sono recensioni!</h3>
        @else    
            <h3><i class="fas fa-star"></i>{{$average}}/5 ({{$numvotes}} {{$numvotes == 1 ? 'recensione' : 'recensioni'}})</h3>
        @endif
        <a class="btn btn-lg btn-danger" href="{{route('admin.apartments.create')}}">Aggiungi un appartamento</a>
    </div>
    @foreach ($apartments as $apartment) 
        <div class="card mb-4 mr-3" style="width: 22rem;">
            @forelse ($apartment->sponsor_plans as $plan)
                @if ($plan->sponsorships->deadline > $now)
                    <h4 class="position-absolute">
                        <span class="badge badge-success p-2 m-2">Sponsorizzato</span>
                    </h4>
                @break
                @elseif ($loop->last)
                    <h4 class="position-absolute">
                        <a  href="{{route('admin.apartments.sponsorship.pay', ['apartment' => $apartment])}}" class="badge badge-secondary p-2 m-2">Sponsorizza!</a>
                    </h4>
                @endif
            @empty
                <h4 class="position-absolute">
                    <a  href="{{route('admin.apartments.sponsorship.pay', ['apartment' => $apartment])}}" class="badge badge-secondary p-2 m-2">Sponsorizza!</a>
                </h4>
            @endforelse
            <?php 
            $count = 0;
            foreach ($apartment->info_requests as $request) {
                $count++;
            }
            if ($count != 0) {
                echo '<h3 class="position-absolute mt-5 ml-2"><span class="badge badge-danger mt-2">'; 
                echo $count;
                echo '</span></h3>';
            }
            ?>
            <a href="{{ route('admin.apartments.show', $apartment->id)}}" class="text-decoration-none">
                <img class="w-100 card-img-top" style="height: 350px; object-fit: cover;" src="{{strpos($apartment->featured_img, '://') ? $apartment->featured_img : asset("/storage/" . $apartment->featured_img)}}" alt="{{$apartment->title}}">
            </a>
            <div class="card-body">
                <a href="{{ route('admin.apartments.show', $apartment->id)}}" class="text-dark text-decoration-none">
                    <h5 class="card-title">{{$apartment->title}}</h5>
                </a>
                <p>{{$apartment->city . ', ' . $apartment->province . ',' . $apartment->region }}</p>
                <strong>{{$apartment->category->name}}</strong>
                <p>{{$apartment->address}}</p>
                <div class="d-flex align-items-center mb-3">
                    <h5 class="mr-2"> {{$apartment->rooms_number}} <i class="fas fa-person-booth text-secondary"></i></h5>
                    <h5 class="mr-2">{{$apartment->beds_number}} <i class="fas fa-bed text-secondary"></i></h5>
                    <h5 class="mr-2">{{$apartment->bathrooms_number}} <i class="fas fa-bath text-secondary"></i></h5>
                    <h5 class="mr-2">{{$apartment->square_meters}} m²</h5>
                </div>
                <div class="services-apartment">
                    <div class="mb-2">
                        <strong>Servizi disponibili</strong>
                    </div>
                    <div class="services-badge">
                        @forelse ($apartment->services as $service)
                            <span class="badge badge-pill badge-primary mb-2">{{$service->name}}</span>
                        @empty
                            <p>Non ci sono servizi aggiuntivi!</p>
                        @endforelse
                    </div>
                </div>      
                {{-- BUTTONS SHOW, DISABLED, DELETE --}}
                <div class="mt-3 d-flex button-options">
                    <a href="{{ route('admin.apartments.show', $apartment->id) }}" class="btn btn-sm btn-primary mr-2">Dettagli</a>
                    <form action="{{ route('admin.apartments.toggle', $apartment->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        @if($apartment->active == 1)
                            <input type="submit" class="btn btn-sm btn-dark mr-2" value="Disabilita">
                        @else 
                            <input type="submit" class="btn btn-sm btn-success mr-2" value="Abilita">
                        @endif
                    </form>
                    <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-sm btn-danger mr-2" type="submit" value="Elimina">
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="wrap-pagination mt-5 d-flex justify-content-center">
    {{$apartments->links()}}
</div>
@endsection