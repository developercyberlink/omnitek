<?php

namespace App\Models\Members;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    protected $table = 'cl_roles';
    protected $fillable = ['role'];

    public function users(){
        return $this->belongsToMany('App\User','role_user','role_id','user_id');
    }
}
