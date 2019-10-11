@extends('layouts.app')
@section('title', 'Add Reservation')
@section('content')
    <div class="row text-center mt-5">
        <div class="col">
            <h1>Add New Reservation</h1>
        </div>
    </div>
@include('partials._flashmessage')
    <div class="row justify-content-center">
        <div class="col-md-4">
            <form class="" action="{{ route('reservations.store') }}" method="POST">
                @include('reservations.form')
                <input class="btn btn-primary" type="submit" value="Add Reservation">
                <a class="btn btn-danger" href="{{ route('reservations.index') }}">Cancel</a>
            </form>
        </div>
    </div>
@endsection
@section('scripts')

@endsection

