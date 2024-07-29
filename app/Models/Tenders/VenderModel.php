<?php

namespace App\Models\Tenders;

use Illuminate\Database\Eloquent\Model;

class VenderModel extends Model
{
    protected $table = "cl_venderdetail";
    protected $fillable = ['vender_name','tender_number','tender_title','tender_category','awarded_date','date_of_nit','value','remarks','email','phone','address'];
}
