<?php

namespace App\Http\Controllers\FrontendControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\SettingModel;
use App\Models\Newsletters\NewsletterSignupModel;
use App\Models\Posts\DwnInfoModel;
use App\Models\Posts\PostDocModel;
use Illuminate\Support\Str;


class NewsletterSignupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = NewsletterSignupModel::where('status',1)->orderBy('id','desc')->get();
        return view('admin.subscribers.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'=> 'Required',
            'last_name'=>'Required',
            'email'=>'Required|email',
            'company'=>'Required'           
            ]);
        $data = $request->all();
       $setting = SettingModel::where('id',1)->first();
         $result = NewsletterSignupModel::create($data);
      if($result){
        return redirect()->back()->with('message','Signup Successfully.');
      }else{
        return 'Error';
      }
     //  Mail::to($setting->email_primary)->send( new NewsletterSignup() );
      // return redirect()->back()->with('message','Contact message successfully sent.');
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $data = NewsletterSignupModel::find($id);  
         $data->delete();
         return 'Are you sure to delete?';
    }

    public function dwnpdf(Request $request){
        
        $request->validate([
            'title'=>'Required', 
            'first_name'=> 'Required',
            'last_name'=>'Required',
            'email'=>'Required',
            'phone'=>'Required',           
            'key_string'=>'Required'           
            ]);
       $data = $request->all();
       if($request->key_string){
           $doc = PostDocModel::where('key_string',$request->key_string)->first();
           $docPath = 'public/uploads/doc/'.$doc->document;
       }
       $result = DwnInfoModel::create($data);
      if($result){
         // $headers[] = ['Content-Type: application/pdf'];
        //$newName = "5c8cfc7b4b5f4.pdf";
        // $headers[] = array('Content-Type' => File::mimeType($docPath));
       // return response()->file($docPath,$newName,$headers);
        return redirect()->back()->with('message','success');
      }else{
        return redirect()->back()->with('message','Try again!');
      }
    }

    public function dwnform(Request $request, $key){
        $data = PostDocModel::where('key_string',$key)->first();
        return view('themes.default.pre-download-form',compact('data'));
    }

}
