<?php

namespace App\Http\Controllers\AdminControllers\MultipleBanners;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MultipleBanners\MultipleBannerModel;
use Illuminate\Support\Str;

use Image;

class MultipleBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = MultipleBannerModel::where('banner_id',$id)->orderBy('id','desc')->get();
        return view('admin.multiplebanner.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.multiplebanner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        // return $request;
        $request->validate([
                'picture'=> 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
            ]);
        $width = env('BANNER_WIDTH');
        $height = env('BANNER_HEIGHT');

        $req = $request->all();
        $file =  $request->file('picture');

        if($request->hasFile('picture')){
            $banner = $request->file('picture')->getClientOriginalName();
            $extension = $request->file('picture')->getClientOriginalExtension();
            $banner = explode('.', $banner);
            $banner_name = Str::slug($banner[0]) . '-' . Str::random(40) . '.' . $extension;
            $destinationPath = public_path('uploads/banners');
            $banner_picture = Image::make($file->getRealPath());
            //$width = Image::make($file->getRealPath())->width();
            //$height = Image::make($file->getRealPath())->height();    
            $banner_picture->resize($width, $height, function($constraint){
                $constraint->aspectRatio();
            })->save($destinationPath .'/'. $banner_name );
        }  
        $req['banner_id'] = $request->parentId;
        $req['picture'] = $banner_name;
        $data = MultipleBannerModel::create($req);
        if($data){
            return redirect()->back()->with('message','Successfully added.');
        }else{
            return "Error";
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
    public function edit($bannerId,$id)
    {
        $data = MultipleBannerModel::find($id);
        return view('admin.multiplebanner.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$bannerid, $id)
    {
        $banner_width = env('BANNER_WIDTH');
        $banner_height = env('BANNER_HEIGHT');
        
        $data = MultipleBannerModel::find($id); 
        $file = $request->file('picture');
 
        if($request->hasFile('picture')){

            // Remove old file if exists
            $data = MultipleBannerModel::find($id);
            if(file_exists(public_path('public/uploads/banners/' .  $data->picture))){   
                unlink('public/uploads/banners/' . $data->picture);
            }

            // Upload new file
            $banner = $request->file('picture')->getClientOriginalName();
            $extension = $request->file('picture')->getClientOriginalExtension();
            $banner = explode('.', $banner);
            $banner_name = Str::slug($banner[0]) . '-' . Str::random(40) . '.' . $extension;
            $destinationPath = public_path('uploads/banners');
            $banner_picture = Image::make($file->getRealPath());
            $banner_picture->resize($banner_width, $banner_height, function($constraint){
                $constraint->aspectRatio();
            })->save($destinationPath .'/'. $banner_name );
            $data->picture = $banner_name;
            }
        
           $data->title = $request->title;
           $data->caption = $request->caption;
           $data->content = $request->content;            
           $data->link = $request->link; 
             $isChecked = $request->has('status');
            $data->status = ($isChecked)?'1':'0'; 
           $data->save(); 
           if($data->save()){
                return redirect()->back()->with('message','Update Successful.'); 
           }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($bannerId, $id)
    {
        $data = MultipleBannerModel::find($id);
        if($data->picture){
        if(file_exists(public_path('public/uploads/banners/' .  $data->picture))){               
            unlink('public/uploads/banners/' . $data->picture);
          }  
        }     

        $data->delete();
        return response()->json([
                    'message' => 'Delete Successful!',
                    'class_name' => 'alert-success'
                ]);
    }
}
