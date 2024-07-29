<?php

namespace App\Models\Galleries;

use Illuminate\Database\Eloquent\Model;

class VideoGalleryCategoryModel extends Model
{
    protected $table = 'cl_gallery_video_categories';
    protected $fillable = ['category','caption','video'];
}
