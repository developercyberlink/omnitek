<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;

class MembershipModel extends Model
{

    protected $visible = ['CompanyName', 'DirectorName', 'MobileNumber','Email', 'PhoneNumber'];

    protected $table = 'cl_membership';
    protected $fillable = [
        'CompanyName','DirectorName','MobileNumber','PhoneNumber','Email','Url','Company','status'
    ];

}
