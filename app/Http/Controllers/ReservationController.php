<?php

namespace App\Http\Controllers;

use App\Placenumber;
use App\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = request()->validate([
            'month' =>  'sometimes',
            'year' =>   'sometimes',
        ]);

        $months = [
            'jan' => 'January',
            'feb' => 'February',
            'mar' => 'March',
            'apr' => 'April',
            'may' => 'May',
            'jun' => 'June',
            'jul' => 'July',
            'aug' => 'August',
            'sep' => 'September',
            'oct' => 'October',
            'nov' => 'November',
            'dec' => 'December',
            ];
        $years = [];
        for($i = 2016; $i <= 2030; $i++) {
            array_push($years, $i);
        }

        $monthNum = null;
        switch(request('month')) {
            case 'jan':
                $monthNum = 1;
                break;
            case 'feb':
                $monthNum = 2;
                break;
            case 'mar':
                $monthNum = 3;
                break;
            case 'apr':
                $monthNum = 4;
                break;
            case 'may':
                $monthNum = 5;
                break;
            case 'jun':
                $monthNum = 6;
                break;
            case 'jul':
                $monthNum = 7;
                break;
            case 'aug':
                $monthNum = 8;
                break;
            case 'sep':
                $monthNum = 9;
                break;
            case 'oct':
                $monthNum = 10;
                break;
            case 'nov':
                $monthNum = 11;
                break;
            case 'dec':
                $monthNum = 12;
                break;
            default:
                $monthNum = date('n');
                break;
        }

        if(request('year') === null){
            $yearNum = date('Y');
        } else {
            $yearNum = request('year');
        }
        $daysInMonth=cal_days_in_month(CAL_GREGORIAN,$monthNum,$yearNum);

        $placeNumbers = Placenumber::all();
//        fetch reservation data

        $reservations = Reservation::all();

        $reservationsPerPlaceNumber = $reservations->groupBy('placeNumber_id');

//  return ($reservationsPerPlaceNumber);
        return view('reservations.index', compact('reservationsPerPlaceNumber', 'daysInMonth', 'months', 'years', 'placeNumbers', 'monthNum', 'yearNum'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $campingSpots = Placenumber::all();
        $reservation = new Reservation();

        $monthNum = null;
        switch(request('month')) {
            case 'jan':
                $monthNum = 1;
                break;
            case 'feb':
                $monthNum = 2;
                break;
            case 'mar':
                $monthNum = 3;
                break;
            case 'apr':
                $monthNum = 4;
                break;
            case 'may':
                $monthNum = 5;
                break;
            case 'jun':
                $monthNum = 6;
                break;
            case 'jul':
                $monthNum = 7;
                break;
            case 'aug':
                $monthNum = 8;
                break;
            case 'sep':
                $monthNum = 9;
                break;
            case 'oct':
                $monthNum = 10;
                break;
            case 'nov':
                $monthNum = 11;
                break;
            case 'dec':
                $monthNum = 12;
                break;
            default:
                $monthNum = date('n');
                break;
        }

        if(request('year') === null){
            $yearNum = date('Y');
        } else {
            $yearNum = request('year');
        }
        $daysInMonth=cal_days_in_month(CAL_GREGORIAN,$monthNum,$yearNum);
        return view('reservations.create', compact('campingSpots', 'reservation', 'daysInMonth', 'yearNum', 'monthNum'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate request
        $attributes = $request->validate([
            'placeNumber_id' => 'required',
            'arrival' => 'required',
            'departure' => 'required',
            'firstName' => 'sometimes',
            'lastName' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'city' => 'required',
            'postalCode' => 'sometimes',
            'address' => 'sometimes',
            'houseNumber' => 'sometimes',
            'sleepingAccommodation' => 'sometimes',
            'adults' => 'required|int',
            'children' => 'nullable',
            'dogs' => 'nullable',
            'remarks' => 'nullable',
            'powerConsumption' => 'sometimes',
            'visitors' => 'sometimes',
            'discount' => 'sometimes',
            'extraCosts' => 'sometimes',
        ]);

        // create and store request
        Reservation::create($attributes);

        // send flashmessage

        // return redirect
        return redirect()->route('reservations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        $months = [
            'jan' => 'January',
            'feb' => 'February',
            'mar' => 'March',
            'apr' => 'April',
            'may' => 'May',
            'jun' => 'June',
            'jul' => 'July',
            'aug' => 'August',
            'sep' => 'September',
            'oct' => 'October',
            'nov' => 'November',
            'dec' => 'December',
        ];
        $monthNum = null;
        switch(request('month')) {
            case 'jan':
                $monthNum = 1;
                break;
            case 'feb':
                $monthNum = 2;
                break;
            case 'mar':
                $monthNum = 3;
                break;
            case 'apr':
                $monthNum = 4;
                break;
            case 'may':
                $monthNum = 5;
                break;
            case 'jun':
                $monthNum = 6;
                break;
            case 'jul':
                $monthNum = 7;
                break;
            case 'aug':
                $monthNum = 8;
                break;
            case 'sep':
                $monthNum = 9;
                break;
            case 'oct':
                $monthNum = 10;
                break;
            case 'nov':
                $monthNum = 11;
                break;
            case 'dec':
                $monthNum = 12;
                break;
            default:
                $monthNum = date('n');
                break;
        }

        if(request('year') === null){
            $yearNum = date('Y');
        } else {
            $yearNum = request('year');
        }
        $daysInMonth=cal_days_in_month(CAL_GREGORIAN,$monthNum,$yearNum);
        return view('reservations.show', compact('reservation', 'daysInMonth'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        $campingSpots = Placenumber::all();
        $months = [
            'jan' => 'January',
            'feb' => 'February',
            'mar' => 'March',
            'apr' => 'April',
            'may' => 'May',
            'jun' => 'June',
            'jul' => 'July',
            'aug' => 'August',
            'sep' => 'September',
            'oct' => 'October',
            'nov' => 'November',
            'dec' => 'December',
        ];
        $monthNum = null;
        switch(request('month')) {
            case 'jan':
                $monthNum = 1;
                break;
            case 'feb':
                $monthNum = 2;
                break;
            case 'mar':
                $monthNum = 3;
                break;
            case 'apr':
                $monthNum = 4;
                break;
            case 'may':
                $monthNum = 5;
                break;
            case 'jun':
                $monthNum = 6;
                break;
            case 'jul':
                $monthNum = 7;
                break;
            case 'aug':
                $monthNum = 8;
                break;
            case 'sep':
                $monthNum = 9;
                break;
            case 'oct':
                $monthNum = 10;
                break;
            case 'nov':
                $monthNum = 11;
                break;
            case 'dec':
                $monthNum = 12;
                break;
            default:
                $monthNum = date('n');
                break;
        }

        if(request('year') === null){
            $yearNum = date('Y');
        } else {
            $yearNum = request('year');
        }
        $daysInMonth=cal_days_in_month(CAL_GREGORIAN,$monthNum,$yearNum);
        return view('reservations.edit', compact('reservation', 'campingSpots', 'daysInMonth'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        // validate
        // validate request
        $attributes = $request->validate([
            'placeNumber_id' => 'required',
            'arrival' => 'required',
            'departure' => 'required',
            'firstName' => 'sometimes',
            'lastName' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'city' => 'required',
            'postalCode' => 'sometimes',
            'address' => 'sometimes',
            'houseNumber' => 'sometimes',
            'sleepingAccommodation' => 'sometimes',
            'adults' => 'required|int',
            'children' => 'nullable',
            'dogs' => 'nullable',
            'remarks' => 'nullable',
            'powerConsumption' => 'sometimes',
            'visitors' => 'sometimes',
            'discount' => 'sometimes',
            'extraCosts' => 'sometimes',
        ]);
        //update
        $reservation->update($attributes);
        //successflash
        session()->flash('message', 'Reservation Updated');
        //return redirect
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index');
    }
}
