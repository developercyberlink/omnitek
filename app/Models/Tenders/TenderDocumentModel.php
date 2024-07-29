<?php

namespace App\Models\Tenders;

use Illuminate\Database\Eloquent\Model;

class TenderDocumentModel extends Model
{
    protected $table = "cl_tender_document";
    protected $fillable = ['tender_id','title','file_name'];
}
