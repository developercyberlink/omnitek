<?php

namespace App\Http\Controllers\AdminControllers\Posts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts\DwnInfoModel;
use Illuminate\Support\Str;


class DwnInfoController extends Controller
{
    public function index(){
    	$data =	DwnInfoModel::orderBy('id','desc')->get();
    	return view('admin.dwninfo.index', compact('data'));
    }
    
     public function destroy($id){
    	$data =	DwnInfoModel::find($id);
    	$data->delete();
    }
}
