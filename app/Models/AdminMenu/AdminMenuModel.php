<?php

namespace App\Models\AdminMenu;

use Illuminate\Database\Eloquent\Model;

class AdminMenuModel extends Model
{
    protected $table = 'cl_admin_menu';
    protected $fillable = ['title'];

    public function users(){
        return $this->belongsToMany('App\User','cl_adminmenu_user','adminmenu_id','user_id');
    }
}
