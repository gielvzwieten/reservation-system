@extends('layouts.app')
@section('title', 'Edit Details for ' . $reservation->lastname)
@section('content')
    <div class="row text-center">
        <div class="col-12">
            <h1>Edit Details for {{ $reservation->lastname }}</h1>
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-6">
            <form action="{{ route('reservations.update', ['reservation' => $reservation]) }}" method="POST">
                @method('PATCH')
                @include('reservations.form')
                <input class="btn btn-primary" type="submit" value="Save Changes">
            </form>
        </div>
    </div>
@endsection

