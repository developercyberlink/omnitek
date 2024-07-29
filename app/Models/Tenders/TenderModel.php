<?php

namespace App\Models\Tenders;

use Illuminate\Database\Eloquent\Model;

class TenderModel extends Model
{
    protected $table = "cl_tender";
    protected $fillable = ['tender_number','tender_subject','tender_location','tender_detail','nit_date','last_date_of_submittion','time_of_submittion','is_new','link_name','publish','status'];
}
