<?php

namespace App\Http\Controllers\AdminControllers\Posts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts\PostImageModel;
use Illuminate\Support\Str;

use Validator;
use Image;

class PostImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($postid)
    {
        $data = PostImageModel::where('post_id',$postid)->get();
        return view('admin.multiple-photo.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = PostImageModel::all();
        return view('admin.multiple-photo.create',compact('data'));
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
            'file_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if($validation->passes()){

        $medium_width = env('MEDIUM_WIDTH');
        $medium_height = env('MEDIUM_HEIGHT');

        $req = $request->all();
        $file =  $request->file('file_image');

        if($request->hasfile('file_image')){
            $_file = $request->file('file_image')->getClientOriginalName();
            $extension = $request->file('file_image')->getClientOriginalExtension();
            $_file = explode('.', $_file);            
            $file_name = Str::slug($_file[0]) . '-' . Str::random(40) . '.' . $extension;
            $destinationPath_medium = public_path('uploads/medium');
            $destinationOriginal = public_path('uploads/galleries');
            $thumbanil_picture = Image::make($file->getRealPath());
            $thumbanil_picture->save($destinationOriginal .'/'. $file_name );
            $thumbanil_picture->resize(1000, 1000, function($constraint){
                $constraint->aspectRatio();
            })->save($destinationPath_medium .'/'. $file_name );           
        }
        
        $req['post_id'] = $request->post_id;
        $req['file_name'] = $file_name;
        $data = PostImageModel::create($req);

        return redirect()->back()->with('message','Image Upload Successful');
         // return response()->json([
         //        'message' => 'Image Upload Successfully',
         //        'class_name' => 'alert-success'
         //    ]);
       
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
    public function edit($id)
    {
        //
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
    public function destroy($psotid,$id)
    {
        $data = PostImageModel::find($id);
        if($data->file_name){
            
        if(file_exists(public_path('uploads/medium/' .  $data->file_name))){
            unlink('uploads/medium/' . $data->file_name);
        }
         if(file_exists(public_path('uploads/galleries/' .  $data->file_name))){
            unlink('uploads/galleries/' . $data->file_name);
        }
        
        }
        $data->delete();
        return response()->json([
                    'message' => 'Delete Successful!',
                    'class_name' => 'alert-success'
                ]);
        }

    public function upload_form($id){
        $data = PostImageModel::where('post_id',$id)->get();
        return view('admin.multiple-photo.create', compact('id','data'));
    }

}
