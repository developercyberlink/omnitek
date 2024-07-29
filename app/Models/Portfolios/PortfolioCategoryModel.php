<?php

namespace App\Models\Portfolios;

use Illuminate\Database\Eloquent\Model;

class PortfolioCategoryModel extends Model
{
    protected $table = 'cl_portfolio_categories';
    protected $fillable = [
    	'category','category_caption','category_content','uri','ordering','thumbnail','status'
    ];
}
