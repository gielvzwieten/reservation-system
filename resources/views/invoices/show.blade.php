@extends('layouts.app')
@section('title', 'individual reservation')
@section('content')

    <div class="row justify-content-center">
        <div class="col-12 col-md-3">
            <form class="form-group" method="post" action="{{ route('reservations.update', ['reservation' => $reservation]) }}">
                @csrf
                @method('PATCH')

                <input type="hidden" name="placeNumber_id" value="{{$reservation->placeNumber_id}}">
                <input type="hidden" name="arrival" value="{{$reservation->arrival->format('Y-m-d') }}">
                <input type="hidden" name="departure" value="{{$reservation->departure->format('Y-m-d')}}">
                <input type="hidden" name="lastName" value="{{$reservation->lastName}}">
                <input type="hidden" name="phone" value="{{$reservation->phone}}">
                <input type="hidden" name="email" value="{{$reservation->email}}">
                <input type="hidden" name="city" value="{{$reservation->city}}">
                <input type="hidden" name="adults" value="{{$reservation->adults}}">

                <label for="visitors">Visitors</label>
                <input class="form-control" type="number" name="visitors" id="visitors" value="{{ old('visitors') ?? $reservation->visitors}}">

                <label for="powerConsumption">Extra electricity costs in €</label>
                <input class="form-control" type="number" name="powerConsumption" id="powerConsumption" value="{{ old('powerConsumption') ?? $reservation->powerConsumption }}">

                <label for="extraCosts">Additional other costs in €</label>
                <input class="form-control" type="number" name="extraCosts" id="extraCosts" value="{{ old('extraCosts') ?? $reservation->extraCosts }}">

                <label for="discount">Discount given in €</label>
                <input class="form-control" type="number" name="discount" id="discount" value="{{ old('discount') ?? $reservation->discount }}">

                <button class="btn btn-primary mt-3" type="submit">Add to invoice</button>
            </form>
        </div>
    </div>

    @php
        $dateDeparture = strtotime($reservation->departure);
        $dateArrival = strtotime($reservation->arrival);
        $days = ($dateDeparture - $dateArrival) / (60 * 60 * 24);

        $pricePerDayPerSpot = 14.50;
        $pricePerDayPerPersonEnvironmentalTax = 1;
        $pricePerDayPerPersonTouristTax = 1.24;
        $pricePerDayPerExtraAdult = 5;
        $pricePerDayPerChild = 3;
        $pricePerDayPerVisitor = 1;
        $pricePerDayPerDog = 1;

        if($reservation->adults >= 3) {
            $extraPriceForExtraAdults = $days *  $pricePerDayPerExtraAdult * ($reservation->adults - 2);
        }
        if($reservation->children >= 1){
        $extraPriceForExtraChildren = $days *  $pricePerDayPerChild * ($reservation->children);
        }

        $totalPrice =
        ($days * $pricePerDayPerSpot)
        + ($days * ($reservation->adults + $reservation->children) * $pricePerDayPerPersonEnvironmentalTax)
        + ($days * ($reservation->adults +$reservation->children) * $pricePerDayPerPersonTouristTax)
        + $extraPriceForExtraAdults
        + $extraPriceForExtraChildren
        + ($days *  $pricePerDayPerDog * ($reservation->dogs))
        + ($pricePerDayPerVisitor * ($reservation->visitors))
        + $reservation->powerConsumption
        + $reservation->extraCosts
        - $reservation->discount;
    @endphp

    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Invoice {{ $reservation->lastName }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">From {{$reservation->arrival->format('d-m-Y')}} till {{$reservation->departure->format('d-m-Y')}}, total days: {{$days}}</h6>

                    <table class="table">
                        <tr>

                        </tr>
                    </table>

                    <p class="card-text">Basic Price for {{ $days }} days: € {{ $days * $pricePerDayPerSpot }}</p>
                    <p class="card-text">Environmental Tax: € {{ $days * ($reservation->adults +$reservation->children) * $pricePerDayPerPersonEnvironmentalTax }}</p>
                    <p class="card-text">Tourist Tax: € {{ $days * ($reservation->adults +$reservation->children) * $pricePerDayPerPersonTouristTax }}</p>
                    @if($reservation->adults >= 3)
                    <p class="card-text">Total Price For Extra Adults: € {{ $extraPriceForExtraAdults }}</p>
                    @endif
                    @if($reservation->children >= 1)
                    <p class="card-text">Total Price For all Children: € {{ $extraPriceForExtraChildren }}</p>
                    @endif

                    @if($reservation->dogs >= 1)
                        <p class="card-text">Total Price For all Dogs: € {{ $days *  $pricePerDayPerDog * ($reservation->dogs) }}</p>
                    @endif

                    @if($reservation->visitors >= 1)
                        <p class="card-text">Total Price For all Visitors: € {{ $pricePerDayPerVisitor * ($reservation->visitors) }}</p>
                    @endif

                    @if($reservation->powerConsumption > 0)
                        <p class="card-text">Extra electricity costs: € {{ $reservation->powerConsumption }}</p>
                    @endif

                    @if($reservation->extraCosts > 0)
                        <p class="card-text">Additional costs: € {{ $reservation->extraCosts }}</p>
                    @endif

                    @if($reservation->discount > 0)
                        <p class="card-text">Given Discount: € -{{ $reservation->discount }}</p>
                    @endif


                    <p class="card-text font-weight-bold">Total Price: € {{$totalPrice}} $</p>
                </div>
            </div>
        </div>
    </div>

@endsection
