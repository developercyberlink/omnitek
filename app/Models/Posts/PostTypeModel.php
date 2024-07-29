<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Posts\PostModel;

class PostTypeModel extends Model
{
    protected $table = 'cl_post_type';
    protected $fillable = ['post_type','uri','uid','caption','banner','content','ordering','is_menu','is_footer_menu','template'];


    public function posts()
    {
        return $this->hasMany('App\Models\Posts\PostModel','post_type');
    }
}
