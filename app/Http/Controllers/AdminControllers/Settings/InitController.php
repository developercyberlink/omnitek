<?php

namespace App\Http\Controllers\AdminControllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\InitModel;
use Illuminate\Support\Str;


class InitController extends Controller
{
    public function index(){
    	$data = InitModel::where('id',1)->first();    	
    	return view('admin.settings.init', compact('data'));
    }

    public function store(Request $request){
    	return $request;
    }

     public function edit(Request $request){
    	$data = InitModel::where('id',1)->first();    	
    	return view('admin.settings.init');
    }

     public function update(Request $request, $id){

     	$data = InitModel::where('id',$id)->first();
        $data->code = $request->code;
        $data->status = $request->status;
        
        if($data->save()){
            return redirect()->back()->with('message','Update Sucessful.');
        }

    }
}
