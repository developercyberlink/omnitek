<?php

namespace App\Models\Portfolios;

use Illuminate\Database\Eloquent\Model;

class PortfolioModel extends Model
{
    protected $table = 'cl_portfolio';
    protected $fillable = [
        'title','sub_title','content','brief','uri','category_id','ordering','thumbnail','icon','page_thumbnail','banner','meta_keyword','meta_description','external_link','status','client_name','country','service','year'
    ];
}
