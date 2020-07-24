@extends('layouts.app')

@section('content')
<div class="container d-flex flex-wrap justify-content-center" style="padding-top: 80px;">
    @foreach ($apartments as $apartment) 
        <div class="card mb-4 mr-3" style="width: 22rem;">
            
            @if($apartment->active == 0)
                <h4 class="position-absolute" style="right:0px;">
                    <span class="badge badge-dark p-2 m-2">Annuncio disabilitato</span>
                </h4>
            @endif

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

            @if(count($apartment->messages) > 0)
                <h3 class="position-absolute mt-5 ml-2">
                    <span class="badge badge-danger mt-2">{{ count($apartment->messages) }}</span>
                </h3>
            @endif

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
                            <p><i>Nessuno<i></p>
                        @endforelse
                    </div>
                </div>      
                {{-- BUTTONS SHOW, DISABLED, DELETE --}}
                <div class="mt-3 d-flex button-options">
                    <a href="{{ route('admin.apartments.show', $apartment->id) }}" class="btn btn-sm btn-info mr-2">Dettagli</a>
                    <a href="{{ route('admin.apartments.edit', $apartment->id) }}" class="btn btn-sm btn-warning mr-2">Modifica</a>
                    <form action="{{ route('admin.apartments.toggle', $apartment->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        @if($apartment->active == 1)
                            <input type="submit" class="btn btn-sm btn-primary mr-2" value="Disabilita">
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
    {{ $apartments->links() }}
</div>
@endsection