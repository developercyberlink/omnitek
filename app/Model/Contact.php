<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
protected $fillable=['first_name','last_name','email','contact','position','company','post_code','address','town','country','comments'];
}
