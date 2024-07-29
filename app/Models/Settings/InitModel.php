<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class InitModel extends Model
{
    protected $table = 'cl_init';
    protected $fillable = ['code','status'];
}
