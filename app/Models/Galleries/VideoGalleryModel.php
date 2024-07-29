<?php

namespace App\Models\Galleries;

use Illuminate\Database\Eloquent\Model;

class VideoGalleryModel extends Model
{
    protected $table = 'cl_gallery_videos';
    protected $fillable = ['category_id','video','caption'];
}
