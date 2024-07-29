<?php

namespace App\Http\Controllers\AdminControllers\Portfolios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Portfolios\AssociatedPortfolioModel;
use Illuminate\Support\Str;

use Image;

class AssociatedPortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    public function associated_post($type,$id){
        $data = AssociatedPortfolioModel::where('portfolio_id',$id)->get();
        return view('admin.associated-portfolio.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ordering = AssociatedPortfolioModel::max('ordering');
            $ordering += 1;
        return view('admin.associated-portfolio.create',compact('ordering'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if($request->has('portfolio_id')){
        $post_type = $request->input('portfolio_id');
      }else{
        return "Invalid Post";
      }

      $request->validate([
        'title'=>'required'
      ]);

      $medium_width = env('MEDIUM_WIDTH');
      $medium_height = env('MEDIUM_HEIGHT');

      $data = $request->all();
      $file =  $request->file('thumbnail');
      $thumbnail_name = '';
      if($request->hasfile('thumbnail')){
        $thumbnail = $request->file('thumbnail')->getClientOriginalName();
        $extension = $request->file('thumbnail')->getClientOriginalExtension();
        $thumbnail = explode('.', $thumbnail);
        $thumbnail_name = Str::slug($thumbnail[0]) . '-' . Str::random(40) . '.' . $extension;

        $destinationPath_medium = public_path('uploads/medium');
        $destinationOriginal = public_path('uploads/original');
        if($extension != 'svg'){
        $thumb_picture = Image::make($file->getRealPath());
        $width = Image::make($file->getRealPath())->width();
        $height = Image::make($file->getRealPath())->height();      

        $thumb_picture->resize($medium_width, $medium_height, function($constraint){
          $constraint->aspectRatio();
        })->save($destinationPath_medium .'/'. $thumbnail_name ); 

        /*Upload Original Image*/
        $thumb_picture->resize($width, $height, function($constraint){
          $constraint->aspectRatio();
        })->save($destinationOriginal .'/'. $thumbnail_name );
      }else if($extension == 'svg'){
        move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $destinationPath_medium.'/'.$thumbnail_name);
      }  

      }
      $data['page_key'] = time().rand(500000,999999999);
      $data['thumbnail'] = $thumbnail_name;    
      $result = AssociatedPortfolioModel::create($data);
      if($result){
        return redirect()->back()->with('message','Successfully added.');
      }else{
        return 'Error';
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
    public function edit($type,$id)
    {
        $data = AssociatedPortfolioModel::find($id);
        return view('admin.associated-portfolio.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$type,$id)
    {
      $medium_width = env('MEDIUM_WIDTH');
      $medium_height = env('MEDIUM_HEIGHT');

      $data = AssociatedPortfolioModel::find($id);  
      $file =  $request->file('thumbnail');
      $thumbnail_name = '';
      if($request->hasfile('thumbnail')){
        $data = AssociatedPortfolioModel::find($id); 
        if($data->thumbnail){
          if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail)){
            unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail);
          }
          if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->thumbnail)){
            unlink(env('PUBLIC_PATH').'uploads/original/' . $data->thumbnail);
          }
        }
        $thumbnail = $request->file('thumbnail')->getClientOriginalName();
        $extension = $request->file('thumbnail')->getClientOriginalExtension();
        $thumbnail = explode('.', $thumbnail);
        $thumbnail_name = Str::slug($thumbnail[0]) . '-' . Str::random(40) . '.' . $extension;

        $destinationPath_medium = public_path('uploads/medium');
        $destinationOriginal = public_path('uploads/original');
        if($extension != 'svg'){
        $thumbnail_picture = Image::make($file->getRealPath());
        $width = Image::make($file->getRealPath())->width();
        $height = Image::make($file->getRealPath())->height();    

        $thumbnail_picture->resize($medium_width, $medium_height, function($constraint){
          $constraint->aspectRatio();
        })->save($destinationPath_medium .'/'. $thumbnail_name ); 

        /*Upload Original Image*/
        $thumbnail_picture->resize($width, $height, function($constraint){
          $constraint->aspectRatio();
        })->save($destinationOriginal .'/'. $thumbnail_name ); 
      }else if($extension == 'svg'){
        move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $destinationPath_medium.'/'.$thumbnail_name);
      }

        $data->thumbnail = $thumbnail_name;
      }    

      $data->title = $request->title;
      $data->brief = $request->brief;
      $data->ordering = $request->ordering;
      if($data->save()){
        return redirect()->back()->with('message','Update Sucessfully.');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type,$id)
    {
        $data = AssociatedPortfolioModel::find($id);
        if($data->thumbnail  != NULL){
        if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail)){
          unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail);
        }
        if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail)){
          unlink(env('PUBLIC_PATH').'uploads/original/' . $data->thumbnail);
        } 
      }
        $data->delete();
        return "Delete Successful";
    }
}
