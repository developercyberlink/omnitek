<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TripBooking extends Model
{
    protected $fillable=['first_name','last_name','email','phone','message','type'];
}
