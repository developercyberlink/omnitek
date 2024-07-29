<?php

namespace App\Http\Controllers\AdminControllers\Tenders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenders\TenderDocumentModel;
use Illuminate\Support\Str;

use Validator;

class TenderDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tender-doc.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view('admin.tender-doc.create');
 }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'file_name' => 'required|mimes:doc,pdf,docx|max:6144'
        ]);
        
        if($validation->passes()){

            $data = $request->all();
            $doc = $request->file('file_name')->getClientOriginalName();
            $extension = $request->file('file_name')->getClientOriginalExtension();
            $doc = explode('.', $doc);
            $file_name = Str::slug($doc[0]) . '-' . uniqid() . '.' . $extension;

            $request->file('file_name')->move( public_path('uploads/doc/'), $file_name);      

            $data['tender_id'] = $request->tender_id;
            $data['title'] = $request->title;
            $data['file_name'] = $file_name;
            $result = TenderDocumentModel::create($data);
            
            if($result){
              return redirect()->back()->with('message','File Upload Successful.');  
            } 

            // return response()->json([
            //     'message' => 'Image Upload Successfully',
            //     'class_name' => 'alert-success'
            // ]);

        }else{
             return redirect()->back()->with('message','Please, Try Again!');  
        //   return response()->json([
        //     'message' => $validation->errors()->all(),
        //     'class_name' => 'alert_danger'
        // ]);
       }
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
        $data = TenderDocumentModel::find($id);
        return view('admin.tender-doc.edit', compact('data'));
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
        $request->validate([
            'file_name' => 'required'
        ]);

        $data = TenderDocumentModel::find($id);
        $data->file_name = $request->file_name;
        if($data->save()){
            return redirect()->back()->with('Update Sucessful.');
        }else{
            return "Error";
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = TenderDocumentModel::find($id);
        if($data->file_name){

            if(file_exists(public_path('uploads/doc/' .  $data->file_name))){
                unlink('uploads/doc/' . $data->file_name);
            }            
        }

        $data->delete();
        return response()->json([
            'message' => 'Delete Successful!',
            'class_name' => 'alert-success'
        ]);


    }

    public function upload_form($id){
        $data = TenderDocumentModel::where('tender_id',$id)->get();
        return view('admin.tender-doc.create', compact('id','data'));
    }

}
