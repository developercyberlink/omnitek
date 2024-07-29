<?php

namespace App\Models\Banners;

use Illuminate\Database\Eloquent\Model;

class BannerModel extends Model
{
    protected $table = 'cl_banner';
    protected $fillable = ['title','caption','banner_content','link_title','link','picture','video','status'];
}
