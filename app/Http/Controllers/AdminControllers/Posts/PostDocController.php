<?php

namespace App\Http\Controllers\AdminControllers\Posts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts\PostDocModel;
use Illuminate\Support\Str;

use Validator;

class PostDocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = PostDocModel::where('post_id',intval($id))->paginate(20);
        return view('admin.multiple-doc.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $post_id = intval($id);
        $ordering = PostDocModel::max('ordering');
        $ordering = $ordering + 1;
        return view('admin.multiple-doc.create', compact('post_id','ordering'));
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
        'document' => 'required',
        'document.*' => 'mimes:doc,pdf,docx' 
    ]);

       if($validation->passes()){

        $data = $request->all();
        $doc = $request->file('document')->getClientOriginalName();
        $extension = $request->file('document')->getClientOriginalExtension();
        $doc = explode('.', $doc);
        $document = Str::slug($doc[0]) . '-' . uniqid() . '.' . $extension;

        $request->file('document')->move( public_path('uploads/doc/'), $document);      
        $data['key_string'] = Str::random(40);
        $data['post_id'] = $request->post_id;
        $data['title'] = $request->title;
        $data['document'] = $document;
        PostDocModel::create($data);

        return redirect()->back()->with('message','File Upload Successful');

    }else{
     return response()->json([
        'message' => $validation->errors()->all(),
        'class_name' => 'alert_danger'
    ]);
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
    public function edit($postId,$id)
    {
        $post_id = intval($postId);
        $data = PostDocModel::find($id);
        return view('admin.multiple-doc.edit', compact('data',intval('post_id')));
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

        $data = PostDocModel::find($id);
        $document = "";
          if($request->hasfile('document')){

            $data = PostDocModel::find($id);
            if($data->document){
             if(file_exists(public_path('uploads/doc/' .  $data->document))){
                unlink('uploads/doc/' . $data->document);
            }
            }

            $doc = $request->file('document')->getClientOriginalName();
            $extension = $request->file('document')->getClientOriginalExtension();
            $doc = explode('.', $doc);
            $document = Str::slug($doc[0]) . '-' . uniqid() . '.' . $extension;
            $request->file('document')->move( public_path('uploads/doc/'), $document); 
            

        $data->document = $document;

    } 

    $data->title = $request->title;
    $data->ordering = $request->ordering;

    if($data->save()){
        return redirect()->back()->with('message','Update Sucessful.');
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
         $data = PostDocModel::find($id);
         if($data->document){               
                if(file_exists(public_path('uploads/doc/' .  $data->document))){
                    unlink('uploads/doc/' . $data->document);
                }                   
            }
         $data->delete();
         return response('Delete Successful.');
    }

 // Delete doc file 
     function delete_doc_file(PostDocModel $postDocModel, $id){
         $data = PostDocModel::find($id);
         if($data->document){               
                if(file_exists(public_path('uploads/doc/' .  $data->document))){
                    unlink('uploads/doc/' . $data->document);
                }                   
            }
         $data->document = NULL;
         $data->save();
         return response('Delete Successful.');
    }


}
