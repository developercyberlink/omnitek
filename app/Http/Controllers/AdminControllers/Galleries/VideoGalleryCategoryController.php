<?php

namespace App\Http\Controllers\AdminControllers\Galleries;

use App\Models\Galleries\VideoGalleryCategoryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;


class VideoGalleryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = VideoGalleryCategoryModel::orderBy('id','desc')->get();
        return view('admin.video-gallery-category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.video-gallery-category.create');
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
            'category'=>'required'
        ]);
        $data = VideoGalleryCategoryModel::create($request->all());
        if($data){
            return redirect()->back()->with('message','Successfully added.');
        }else{
            return 'Error';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galleries\VideoGalleryCategoryModel  $videoGalleryCategoryModel
     * @return \Illuminate\Http\Response
     */
    public function show(VideoGalleryCategoryModel $videoGalleryCategoryModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galleries\VideoGalleryCategoryModel  $videoGalleryCategoryModel
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoGalleryCategoryModel $videoGalleryCategoryModel, $id)
    {
        $data = VideoGalleryCategoryModel::find($id);
        return view('admin.video-gallery-category.edit', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galleries\VideoGalleryCategoryModel  $videoGalleryCategoryModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoGalleryCategoryModel $videoGalleryCategoryModel, $id)
    {
        $data = VideoGalleryCategoryModel::find($id);
        $data->category = $request->category;
        $data->video = $request->video;
        $data->caption = $request->caption;
        $data->save();
        return redirect()->back()->with('message','Update Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galleries\VideoGalleryCategoryModel  $videoGalleryCategoryModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoGalleryCategoryModel $videoGalleryCategoryModel, $id)
    {
        $data = VideoGalleryCategoryModel::find($id);
        $data->delete();
    }
}
