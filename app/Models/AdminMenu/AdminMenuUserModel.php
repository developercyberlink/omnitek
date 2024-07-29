<?php

namespace App\Models\AdminMenu;

use Illuminate\Database\Eloquent\Model;

class AdminMenuUserModel extends Model
{
    public $timestamps = false;
    protected $table = 'cl_adminmenu_user';
    protected $fillable = ['user_id','adminmenu_id'];
}
