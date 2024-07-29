<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
    protected $table = "cl_country";
    protected $fillable = ['country'];
}
