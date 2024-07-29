<?php

namespace App\Http\Controllers\AdminControllers\Galleries;

use App\Models\Galleries\VideoGalleryModel;
use App\Models\Galleries\VideoGalleryCategoryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;


class VideoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = VideoGalleryModel::all();
        return view('admin.video-gallery.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = VideoGalleryCategoryModel::all();
        return view('admin.video-gallery.create', compact('data'));
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
            'video'=>'required'
        ]);
        $data = VideoGalleryModel::create($request->all());
        if($data){
            return redirect()->back()->with('message', 'Successfully added.');
        }else{
            return 'Error';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galleries\VideoGalleryModel  $videoGalleryModel
     * @return \Illuminate\Http\Response
     */
    public function show(VideoGalleryModel $videoGalleryModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galleries\VideoGalleryModel  $videoGalleryModel
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoGalleryModel $videoGalleryModel, $id)
    {
        $data = VideoGalleryModel::find($id);
        $category = VideoGalleryCategoryModel::all();
        return view('admin.video-gallery.edit', compact('data','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galleries\VideoGalleryModel  $videoGalleryModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoGalleryModel $videoGalleryModel, $id)
    {
        $data = VideoGalleryModel::find($id);
        $data->category_id = $request->category_id;
        $data->video = $request->video;
        $data->caption = $request->caption;
        $data->save();
        return redirect()->back()->with('message','Update Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galleries\VideoGalleryModel  $videoGalleryModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoGalleryModel $videoGalleryModel, $id)
    {
        $data = VideoGalleryModel::find($id);
        $data->delete();
    }
}
