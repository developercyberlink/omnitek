<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostVideoModel extends Model
{
    protected $table = 'cl_multiple_video';
    protected $fillable = ['title','post_id','ordering','video'];
}
