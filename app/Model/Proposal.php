<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable=['first_name','last_name','email','contact','position','company','post_code','country','industry','revenue','options','rfp','comments'];
}
