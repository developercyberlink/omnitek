<?php

namespace App\Models\Circulars;

use Illuminate\Database\Eloquent\Model;

class CircularModel extends Model
{
    protected $table = 'cl_circulars';
    protected $fillable = [
        'circular_date','circular_title','sub_title','circular_content','circular_excerpt','uri','circular_type','ordering','circular_thumbnail','department','members','status','published','is_active','is_trashed','is_commentable','lang'
    ];
}
