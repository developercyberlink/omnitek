<?php

namespace App\Models\Portfolios;

use Illuminate\Database\Eloquent\Model;

class AssociatedPortfolioModel extends Model
{
    protected $table = 'cl_associated_portfolios';
    protected $fillable = ['portfolio_id','title','brief','thumbnail','ordering','uri','page_key'];
}
