<?php

namespace App\Http\Controllers\AdminControllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\SettingModel;
use Illuminate\Support\Str;


class SettingController extends Controller
{
    public function index(){
    	$data = SettingModel::where('id',1)->first();
    	return view('admin.settings.setting', compact('data'));
    }

    public function store(Request $request){
    	return $request;
    }

     public function edit(Request $request){
    	$data = SettingModel::where('id',1)->first();
    	return view('admin.settings.setting');
    }

     public function update(Request $request, $id){
     	$data = SettingModel::where('id',$id)->first();
        $data->site_name = $request->site_name;
        $data->location1 = $request->location1;
        $data->location2 = $request->location2;
        $data->phone = $request->phone;
        $data->phone2 = $request->phone2;
        $data->email_primary = $request->email_primary;
        $data->email_secondary = $request->email_secondary;
        $data->website = $request->website;
        $data->website2 = $request->website2;
        $data->address = $request->address;
        $data->address2 = $request->address2;
        $data->facebook_link = $request->facebook_link;
        $data->linkedin_link = $request->linkedin_link;
        $data->youtube_link = $request->youtube_link;
        $data->twitter_link = $request->twitter_link;
        $data->instagram_link = $request->instagram_link;
        $data->location_link = $request->location_link;
        $data->signin_url = $request->signin_url;
        $data->signup_url = $request->signup_url;
        $data->experience = $request->experience;
        $data->google_plus = $request->google_plus;
        $data->meta_key = $request->meta_key;
        $data->meta_description = $request->meta_description;
        $data->google_map = $request->google_map;
        $data->google_map2 = $request->google_map2;
        $data->welcome_title = $request->welcome_title;
        $data->welcome_text = $request->welcome_text;
        $data->copyright_text = $request->copyright_text;
        $data->field1 = $request->field1;
        $data->field2 = $request->field2;
        $data->field3 = $request->field3;
        $data->field4 = $request->field4;
        if($data->save()){
            return redirect()->back()->with('message','Update Sucessfully.');
        }
    }
}
