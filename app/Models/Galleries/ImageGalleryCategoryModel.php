<?php

namespace App\Models\Galleries;

use Illuminate\Database\Eloquent\Model;

class ImageGalleryCategoryModel extends Model
{
    protected $table = 'cl_gallery_image_categories';
    protected $fillable = ['category','caption','picture'];
}
