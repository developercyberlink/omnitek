<?php

namespace App\Models\Departments;

use Illuminate\Database\Eloquent\Model;

class DepartmentModel extends Model
{
    protected $table = 'cl_department';
    protected $fillable = ['department'];
}
