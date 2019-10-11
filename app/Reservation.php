<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $guarded = [];
    protected $dates = ['arrival', 'departure'];

    public function placenumber()
    {
        return $this->belongsTo(Placenumber::class);
    }
}
