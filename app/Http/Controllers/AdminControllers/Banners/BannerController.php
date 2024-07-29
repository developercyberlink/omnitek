<?php
namespace App\Http\Controllers\AdminControllers\Banners;

use App\Models\Banners\BannerModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use Image;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = BannerModel::orderBy('id','desc')->get();
        return view('admin.banner.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.banner.create');
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
        'picture'=> 'required|image|mimes:jpeg,png,jpg,gif|max:3072',
        'title'=>'required'
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
    $req['picture'] = $banner_name;
    $data = BannerModel::create($req);
    if($data){
        return redirect()->back()->with('message','Successfully added.');
    }else{
        return "Error";
    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banners\BannerModel  $bannerModel
     * @return \Illuminate\Http\Response
     */
    public function show(BannerModel $bannerModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banners\BannerModel  $bannerModel
     * @return \Illuminate\Http\Response
     */
    public function edit(BannerModel $bannerModel, $id)
    {
        $data = BannerModel::find($id);
        return view('admin.banner.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banners\BannerModel  $bannerModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BannerModel $bannerModel, $id)
    {
        $request->validate([
        'title'=>'required'
        ]);
       // dd($request->content);
        $banner_width = env('BANNER_WIDTH');
        $banner_height = env('BANNER_HEIGHT');

        $data = BannerModel::find($id);
        $file = $request->file('picture');

        if($request->hasFile('picture')){

            // Remove old file if exists
            $data = BannerModel::find($id);
            if(file_exists(public_path('uploads/banners/' .  $data->picture))){
                unlink('uploads/banners/' . $data->picture);
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
           $data->banner_content = $request->banner_content;
           $data->link_title = $request->link_title;
           $data->link = $request->link;
           $data->video = $request->video;
           $data->save();
           if($data->save()){
                return redirect()->back()->with('message','Update Successful.');
           }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banners\BannerModel  $bannerModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(BannerModel $bannerModel, $id)
    {
        $data = BannerModel::find($id);
        if(file_exists(public_path('uploads/banners/' .  $data->picture))){
              unlink('uploads/banners/' . $data->picture);
            }
        $data->delete();
    }
}
