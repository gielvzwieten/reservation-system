@extends('layouts.app')
@section('title', 'individual reservation')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col">
                            <h5 class="card-title float-left">{{$reservation->lastName}}</h5>

                            <a class="btn btn-primary float-right" href="{{ route('invoices.show', ['reservation' => $reservation]) }}">Invoice <i class="fas fa-receipt"></i></a>
                        </div>
                    </div>

                    <h6 class="card-subtitle mb-2 text-muted">From {{$reservation->arrival->format('d-m-Y')}} till {{$reservation->departure->format('d-m-Y')}}</h6>
                    <p class="card-text">City: {{$reservation->city}}</p>
                    <p class="card-text">Adults: {{$reservation->adults}}</p>
                    <p class="card-text">Children: {{$reservation->children}}</p>
                    <p class="card-text">Camping Spot: {{$reservation->placeNumber_id}}</p>
                    <div class="row justify-content-md-start">
                        <div class="col d-flex">
                            <a href="{{route('reservations.edit', ['reservation' => $reservation])}}" class="btn btn-warning">Edit</a>
                            <form class="ml-3" action="{{ route('reservations.destroy', ['reservation' => $reservation]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Delete">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection