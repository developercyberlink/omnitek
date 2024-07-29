<?php

namespace App\Models\MultipleBanners;

use Illuminate\Database\Eloquent\Model;

class MultipleBannerModel extends Model
{
    protected $table = 'cl_multiple_banner';
    protected $fillable = [ 
    	'title','banner_id','caption','content','picture','link','status'
    ];
}
