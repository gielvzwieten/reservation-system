<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Placenumber extends Model
{
    protected $guarded = [];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
