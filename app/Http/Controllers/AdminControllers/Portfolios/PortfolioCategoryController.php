<?php

namespace App\Http\Controllers\AdminControllers\Portfolios;

use App\Models\Portfolios\PortfolioCategoryModel;
use App\Models\Portfolios\PortfolioTypeModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use Image;

class PortfolioCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data = PortfolioCategoryModel::orderBy('id','desc')->get();
       return view('admin.portfolio-category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = PortfolioCategoryModel::all();
        return view('admin.portfolio-category.create', compact('data'));
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
            'category'=>'required',
            'uri'=>'required'
        ]);
        $data = $request->all();
        $file =  $request->file('thumbnail');
        if($request->hasfile('thumbnail')){

            $category_file = $request->file('thumbnail')->getClientOriginalName();
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $category_file = explode('.', $category_file);
            $file_name = Str::slug( 'icon-'.$category_file[0]) . '-' . Str::random(40) . '.' . $extension;

            $destinationOriginal = public_path('uploads/original');
            $pic = Image::make($file->getRealPath());
            $width = Image::make($file->getRealPath())->width();
            $height = Image::make($file->getRealPath())->height(); 

            $pic->resize($width, $height, function($constraint){
            $constraint->aspectRatio();
             })->save($destinationOriginal .'/'. $file_name );
             $data['thumbnail'] = $file_name;
        }

        $data['uri'] = Str::slug($request->uri);        
        $result = PortfolioCategoryModel::create($data);
        if($result){
            return redirect()->back()->with('message','Successfully added.');
        }else{
            return "Error";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts\PortfolioCategoryModel  $portfolioCategoryModel
     * @return \Illuminate\Http\Response
     */
    public function show(PortfolioCategoryModel $portfolioCategoryModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolios\PortfolioCategoryModel  $portfolioCategoryModel
     * @return \Illuminate\Http\Response
     */
    public function edit(PortfolioCategoryModel $portfolioCategoryModel, $id)
    {   
       $data = PortfolioCategoryModel::find($id);
       return view('admin.portfolio-category.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolios\PortfolioCategoryModel  $portfolioCategoryModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PortfolioCategoryModel $portfolioCategoryModel, $id)
    {
        $request->validate([
            'category'=>'required',
            'uri'=>'required'
        ]);
        
        $data = PortfolioCategoryModel::find($id);
        $file =  $request->file('thumbnail');
        $file_name = '';
        if($request->hasfile('thumbnail')){
            $data = PortfolioCategoryModel::find($id);  
            if($data->thumbnail){               
                if(file_exists(public_path('uploads/original/' .  $data->thumbnail))){
                    unlink('uploads/original/' . $data->thumbnail);
                }                  
            }
            $category_file = $request->file('thumbnail')->getClientOriginalName();
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $category_file = explode('.', $category_file);
            $file_name = Str::slug($category_file[0]) . '-' . Str::random(40) . '.' . $extension;
            
            $destinationOriginal = public_path('uploads/original');
            

        $product_picture = Image::make($file->getRealPath());
        $width = Image::make($file->getRealPath())->width();
        $height = Image::make($file->getRealPath())->height();        
      
        /****Upload Original Image****/
        $product_picture->resize($width, $height, function($constraint){
            $constraint->aspectRatio();
             })->save($destinationOriginal .'/'. $file_name ); 

        $data->thumbnail = $file_name;
        }   

        $data->category = $request->category;
        $data->category_caption = $request->category_caption;
        $data->uri = Str::slug($request->uri);  
        $data->ordering = $request->ordering;  
        $data->category_content = $request->category_content;  
        $data->thumbnail = $request->thumbnail;              
        $data->save();
        return redirect()->back()->with('message','Update Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolios\PortfolioCategoryModel  $portfolioCategoryModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(PortfolioCategoryModel $portfolioCategoryModel, $id)
    {
        $data = PortfolioCategoryModel::find($id);
         if($data->thumbnail  != NULL){
            unlink('uploads/original/' . $data->thumbnail );
        }
        $data->delete();
        return 'Are you sure to delete?';
    }

     // Delete Post Thumbnail
     function delete_category_thumb(PortfolioCategoryModel $portfolioCategoryModel, $id){
         $data = PortfolioCategoryModel::find($id);
         if($data->thumbnail){                
                if(file_exists(public_path('uploads/original/' .  $data->thumbnail))){
                    unlink('uploads/original/' . $data->thumbnail);
                }                   
            }
         $data->thumbnail = NULL;
         $data->save();
         return response('Delete Successful.');
    }


}
