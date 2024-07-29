<?php

namespace App\Models\Tenders;

use Illuminate\Database\Eloquent\Model;

class TenderCategoryModel extends Model
{
    protected $table = "cl_tender_category";
    protected $fillable = ['tender_category'];
}
