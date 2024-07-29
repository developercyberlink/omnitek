<?php

namespace App\Http\Controllers\AdminControllers\Galleries;

use App\Models\Galleries\ImageGalleryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Galleries\ImageGalleryCategoryModel;
use Illuminate\Support\Str;

use Image;

class ImageGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ImageGalleryModel::orderBy('id','desc')->get();
        return view('admin.image-gallery.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ImageGalleryCategoryModel::all();
        return view('admin.image-gallery.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $file = $request->file('picture');
        if($request->hasFile('picture')){
            $thumb_width = env('GALLERY_IMAGE_THUMB_WIDTH');
            $thumb_height = env('GALLERY_IMAGE_THUMB_HEIGHT');
            $file = $request->file('picture');
            $picture = $request->file('picture')->getClientOriginalName();
            $extension = $request->file('picture')->getClientOriginalExtension();
            $picture = explode('.', $picture);
        $picture_name = Str::slug($picture[0]) .'-'. Str::random(25) . '.' . $extension;
            $destinationPath = public_path('uploads/galleries');
            $gallery_picture = Image::make($file->getRealPath());
            $gallery_picture->resize($thumb_width,$thumb_height,function($constraint){
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$picture_name);
        }
        $data['picture'] = $picture_name; 
        $result = ImageGalleryModel::create($data);
        if($result){
            return redirect()->back()->with('message','Successfully added.');
        }else{
            return 'Error';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galleries\ImageGalleryModel  $imageGalleryModel
     * @return \Illuminate\Http\Response
     */
    public function show(ImageGalleryModel $imageGalleryModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galleries\ImageGalleryModel  $imageGalleryModel
     * @return \Illuminate\Http\Response
     */
    public function edit(ImageGalleryModel $imageGalleryModel, $id)
    {
        $data = ImageGalleryModel::find($id);
        $category = ImageGalleryCategoryModel::all();
        return view('admin.image-gallery.edit', compact('data','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galleries\ImageGalleryModel  $imageGalleryModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImageGalleryModel $imageGalleryModel, $id)
    {
        $data = ImageGalleryModel::find($id);   
        $data->category_id = $request->category_id;
        $data->caption = $request->caption;
        if($request->hasFile('picture')){

            $thumb_width = env('GALLERY_IMAGE_THUMB_WIDTH');
            $thumb_height = env('GALLERY_IMAGE_THUMB_HEIGHT');
            $file = $request->file('picture'); 
            if(file_exists(public_path('uploads/galleries/' . $data->picture ))){
                unlink(public_path('uploads/galleries/' . $data->picture ));
            }

            $picture = $request->file('picture')->getClientOriginalName();
            $extension = $request->file('picture')->getClientOriginalExtension();
            $picture = explode('.', $picture);
            $picture_name = Str::slug($picture[0]) .'-'. Str::random(40) .'.'. $extension;
            $destinationPath = public_path('uploads/galleries');
            $gallery_picture = Image::make($file->getRealPath());
            $gallery_picture->resize($thumb_width,$thumb_height, function($constraint){
                $constraint->aspectRatio();
            })->save($destinationPath .'/'. $picture_name); 

            $data->picture = $picture_name;  
        }
        
        $data->save();        
        return redirect()->back()->with('message','Update Successful.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galleries\ImageGalleryModel  $imageGalleryModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageGalleryModel $imageGalleryModel, $id)
    {
        $data = ImageGalleryModel::find($id);
        if(file_exists(public_path('uploads/galleries/' . $data->picture ))){
            unlink(public_path('uploads/galleries/' . $data->picture ));
        }
        $data->delete();
    }
}
