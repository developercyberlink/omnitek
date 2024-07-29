<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class AssociatedPostModel extends Model
{
    protected $table = 'cl_associated_posts';
    protected $fillable = ['post_id','title','sub_title','brief','thumbnail','icon','ordering','uri','page_key','phone','email','facebook_link','twitter_link','linked_in_link'];


}
