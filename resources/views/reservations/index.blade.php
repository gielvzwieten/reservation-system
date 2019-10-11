@extends('layouts.app')
@section('title', 'Reservations Overview')
@section('styles')
    <style>
        .parent {
            display: grid;
            grid-template-columns: repeat({{$daysInMonth + 1 ?? '' }} , 1fr);
            grid-template-rows: repeat(5, 1fr);
            grid-column-gap: 0px;
            grid-row-gap: 0px;
        }

        .min-height-50 {
            min-height: 50px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .first {
            position: relative;
            height: 100%;
            background: linear-gradient(90deg, #38c172 60%, #e3342f 30%);
        }

        .last {
            position: relative;
            height: 100%;
            background: linear-gradient(90deg, #e3342f 40%, #38c172 20%);
        }

        .both {
            height: 100%;
            background: linear-gradient(to left,
            #e3342f 40%, #38c172 25%, #38c172 50%, #38c172 50%, #38c172 60%, #e3342f 33% );

        }
    </style>
@endsection
@section('content')
    {{--header row--}}
    <div class="row align-items-center mt-5">
        <div class="col-6">
            <h1>Reservations</h1>
        </div>
        <div class="input-group col-4 col-md-3">
            <input class="form-control" type="text" placeholder="search">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">Go</button>
            </div>
        </div>
         <div class="col-2 col-md-3">
             <a class="btn btn-primary" href="{{ route('reservations.create') }}">Add New Reservation <i class="fas fa-plus"></i></a>
         </div>
    </div> {{--End header row--}}

    {{--Month and year selection--}}
    <form class="row mt-5" action="{{ route('reservations.index') }}" method="GET">
        {{--Get Month--}}
        <div class="form-group col-6 col-md-1">
            <select class="form-control mb-3" name="month" id="month" onChange="this.form.submit()">
                @if(request('month') === null)
                    <option value="" selected disabled>{{date('F')}}</option>
                @else
                    <option value="" selected disabled>Choose Month</option>
                @endif
                @foreach($months as $key => $month)
                    <option {{ request('month') == $key ?  'selected' : ''}} value="{{$key}}">{{ $month }}</option>
                @endforeach
            </select>
        </div>

        {{--Get Year Form--}}
        <div class="col-6 col-md-1 form-group">
            <select class="form-control mb-3" name="year" id="year" onChange="this.form.submit()">
                @if(request('year') === null)
                    <option value="" selected disabled>{{date('Y')}}</option>
                @else
                    <option value="" selected disabled>Choose Year</option>
                @endif
                @foreach($years as $year)
                    <option {{ request('year') == $year ?  'selected' : ''}} value="{{$year}}">{{$year}}</option>
                @endforeach
            </select>
        </div>
    </form>

    {{--Table Reservation overview--}}
    {{--<div class="row mt-5">--}}
        {{--<div class="col">--}}
            {{--<table class="table">--}}
                {{--<thead>--}}
                {{--<tr>--}}
                    {{--<th># Place</th>--}}
                    {{--date days--}}
                    {{--@for($i=1; $i<$daysInMonth +1; $i++)--}}
                        {{--<th>{{$i}}</th>--}}
                    {{--@endfor--}}
                {{--</tr>--}}
                {{--</thead>--}}

                {{--<tbody>--}}
                {{--voor elke plek een row in de table--}}
                {{--@foreach($placeNumbers as $placeNumber)--}}
                    {{--<tr class="border-bottom bg-success">--}}
                        {{--voor elke plek een nummer links in table--}}
                        {{--<td class="border-right bg-light">{{$placeNumber->placenumber}}</td>--}}
                        {{--voor elke dag in de maand een table cel--}}
                        {{--@for($i=1; $i<=$daysInMonth; $i++)--}}
                            {{--@php--}}
                                {{--$reserved = false;--}}
                                {{--$date = (new \DateTime())->setDate($yearNum, $monthNum, $i);--}}
                                {{--$link = "";--}}
                            {{--@endphp--}}

{{--Check IF: placenumber in current month has a reservation, --}}

                                {{--@foreach($reservationsPerPlaceNumber[$placeNumber->id] as $reservation)--}}
                                    {{--@if(array_key_exists($placeNumber->id,$reservationsPerPlaceNumber))--}}
                                        {{--@if($date >= $reservation->arrival && $date <= $reservation->departure)--}}
                                            {{--@php $reserved = true; $link = $reservation->id @endphp--}}
                                        {{--@endif--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}

                            {{--<td class="{{$reserved ? 'bg-danger' : 'bg-success'}} border"><a href="/reservations/{{$link}}">{{$link}}</a></td>--}}
                        {{--@endfor--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
                {{--</tbody>--}}
            {{--</table>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="parent">
        <div>#</div>
        @for($i=1; $i<$daysInMonth +1; $i++)
            <div class="text-center">{{$i}}</div>
        @endfor

        @foreach($placeNumbers as $placeNumber)
            {{--voor elke plek een nummer links in table--}}
            <div class="border-right border-bottom bg-light">{{$placeNumber->placeNumber}}</div>
            {{--voor elke dag in de maand een table cel--}}
            @for($i=1; $i<=$daysInMonth; $i++)
                @php
                    $reserved = false;
                    $arrivalDay = false;
                    $departureDay = false;
                    $date = (new \DateTime())->setDate($yearNum, $monthNum, $i)->setTime(0,0,0,0);
                    $link = "";
                @endphp

                {{--Check IF: placenumber in current month has a reservation, --}}
                @if(isset($reservationsPerPlaceNumber[$placeNumber->id]))

                    @foreach($reservationsPerPlaceNumber[$placeNumber->id] as $reservation)

                        @if($date == $reservation->arrival)
                            @php $arrivalDay = true; @endphp

                        @elseif($date == $reservation->departure)
                            @php $departureDay = true; @endphp

                        @elseif($date > $reservation->arrival && $date < $reservation->departure)
                            @php
                                $reserved = true;
                                $link = $reservation->id;
                                $lastName = $reservation->lastName;
                            @endphp
                        @endif

                    @endforeach
                @endif

                @if($arrivalDay || $departureDay)
                    <div class="border text-center {{$arrivalDay ? 'first' : ''}} {{$departureDay ? 'last' : ''}} @if($departureDay && $arrivalDay) {{'both'}} @endif min-height-50"></div>
                @elseif($reserved)
                    <div class="border text-center {{$reserved ? 'bg-danger' : 'bg-success'}} min-height-50"><a href="/reservations/{{$link}}">{{$lastName}}</a></div>
                @else

                    <div class="border text-center bg-success min-height-50"></div>
                @endif

            @endfor

        @endforeach

    </div>
@endsection

@section('scripts')

@endsection
