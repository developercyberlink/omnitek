<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['full_name',  'email', 'contact',  'address', 'gender', 'day','month','year','department',
        'doctor','appoint_date','time'];
}
