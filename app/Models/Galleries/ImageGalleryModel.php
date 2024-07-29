<?php

namespace App\Models\Galleries;

use Illuminate\Database\Eloquent\Model;

class ImageGalleryModel extends Model
{
    protected $table = 'cl_gallery_images';
    protected $fillable = ['category_id','picture','caption'];
}
