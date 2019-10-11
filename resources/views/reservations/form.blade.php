    @csrf
    {{--placeNumber_id--}}
    <div class="form-group">
        <label for="placeNumber_id">Camping Spot *</label>
        <select class="form-control" name="placeNumber_id" id="placeNumber_id">
            <option value="" disabled selected>Choose spot..</option>
            @foreach($campingSpots as $campingSpot)
                @if($campingSpot->id == $reservation->placeNumber_id)
                    <option value="{{ $campingSpot->id }}" selected>Spot: {{$campingSpot->placeNumber}}</option>
                @else
                    <option value="{{ $campingSpot->id }}" {{ old('placeNumber_id') == $campingSpot->id ? 'selected' : '' }}>Spot: {{$campingSpot->placeNumber}}</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="form-row">
        {{--Arrival--}}
        <div class="form-group col-md-6">
            <label>Arrival *</label>
            <input type="date" name="arrival" max="3000-12-31"
                   min="1000-01-01" class="form-control" value="{{ old('arrival') ?? $reservation->arrival }}">
        </div>
        {{--Departure--}}
        <div class="form-group col-md-6">
            <label>Departure *</label>
            <input type="date" name="departure" min="1000-01-01"
                   max="3000-12-31" class="form-control" value="{{ old('departure') ?? $reservation->departure }}">
        </div>
    </div>

    <div class="form-row">
        {{--firstName--}}
        <div class="form-group col-md-6">
            <label for="firstName">First name</label>
            <input class="form-control" type="text" name="firstName" id="firstName" placeholder="First name(s)" value="{{ old('firstName') ?? $reservation->firstName }}">
        </div>
        {{--lastName--}}
        <div class="form-group col-md-6">
            <label for="lastName">Last name *</label>
            <input class="form-control" type="text" name="lastName" id="lastName" placeholder="Last name" value="{{ old('lastName') ?? $reservation->lastName }}">
        </div>
    </div>

    <div class="form-row">
        {{--phone--}}
        <div class="form-group col-md-6">
            <label for="phone">Phone number *</label>
            <input class="form-control" type="number" name="phone" id="phone" placeholder="Phone number" value="{{old('phone') ?? $reservation->phone}}">
        </div>
        {{--email--}}
        <div class="form-group col-md-6">
            <label for="email">Email *</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="Email" value="{{old('email') ?? $reservation->email}}">
        </div>
    </div>

    <div class="form-row">
        {{--city--}}
        <div class="form-group col-md-8">
            <label for="city">City *</label>
            <input class="form-control" type="text" name="city" id="city" placeholder="City" value="{{old('city') ?? $reservation->city}}">
        </div>
        {{--postalCode--}}
        <div class="form-group col-md-4">
            <label for="postalCode">Zip Code</label>
            <input class="form-control" type="text" name="postalCode" id="postalCode" placeholder="Zip code" value="{{old('postalCode') ?? $reservation->postalCode}}">
        </div>
    </div>

    <div class="form-row">
        {{--address--}}
        <div class="form-group col-md-9">
            <label for="address">Address *</label>
            <input class="form-control" type="text" name="address" id="address" placeholder="Address" value="{{old('address') ?? $reservation->address}}">
        </div>
        {{--houseNumber--}}
        <div class="form-group col-md-3">
            <label for="houseNumber">House number *</label>
            <input class="form-control" type="number" name="houseNumber" id="houseNumber" placeholder="House number" value="{{old('houseNumber') ?? $reservation->houseNumber}}">
        </div>
    </div>

    {{--sleepingAccommodation--}}
    <div class="form-group">
        <label for="sleepingAccommodation">Sleeping Accommodation</label>
        <select class="form-control" name="sleepingAccommodation" id="sleepingAccommodation">
            <option value="" disabled selected>Choose sleeping accommodation..</option>
            <option value="1">Caravan</option>
            <option value="2">Camper Van</option>
            <option value="3">Folding Trailer</option>
            <option value="4">Tent</option>
        </select>
    </div>

    <div class="form-row">
        {{--Adults--}}
        <div class="form-group col-md-4">
            <label for="adults">Adults</label>
            <input class="form-control" type="number" name="adults" id="adults" placeholder="Adults" value="{{old('adults') ?? $reservation->adults}}">
        </div>
        {{--Children--}}
        <div class="form-group col-md-4">
            <label for="children">Children</label>
            <input class="form-control" type="number" name="children" id="children" placeholder="Children" value="{{old('children') ?? $reservation->children}}">
        </div>
        {{--dogs--}}
        <div class="form-group col-md-4">
            <label for="dogs">Dogs</label>
            <input class="form-control" type="number" name="dogs" id="dogs" placeholder="Dogs" value="{{old('dogs') ?? $reservation->dogs}}">
        </div>
    </div>




    {{--remarks--}}
    <div class="formgroup">
        <label for="remarks">Remarks</label>
        <textarea class="form-control mb-2" name="remarks" id="remarks" cols="30" rows="4">{{old('remarks') ?? $reservation->remarks}}</textarea>
    </div>






