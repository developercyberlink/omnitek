<?php

namespace App\Models\Circulars;

use Illuminate\Database\Eloquent\Model;

class CircularTypeModel extends Model
{
    protected $table = 'cl_circular_type';
    protected $fillable = ['circular_type','uri','ordering'];
}
