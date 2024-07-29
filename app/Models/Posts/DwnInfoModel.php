<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class DwnInfoModel extends Model
{
    protected $table = "cl_dwninfo";
    protected $fillable = ['title','first_name','last_name','email','phone'];
}
