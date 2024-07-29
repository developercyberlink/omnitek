<?php

namespace App\Http\Controllers\AdminControllers\Posts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts\PostVideoModel;
use Illuminate\Support\Str;

// use Validation;

class MultipleVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = PostVideoModel::where('post_id',intval($id))->paginate(20);
        return view('admin.multiple-video.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = PostVideoModel::all();
        return view('admin.multiple-video.create', compact('data'));
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

        $data = PostVideoModel::create($request->all());
        $lastId =  $data->id;
        if($data){
            return redirect()->back()->with('message','Video Upload Successful.');
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
        $data = PostVideoModel::find($id);
        return view('admin.multiple-video.edit', compact('data',intval('post_id')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$postid, $id)
    {
       $request->validate([
            'video'=>'required'
       ]);
        $data = PostVideoModel::find($id);
        $data->title = $request->title;
        $data->ordering = $request->ordering;
        $data->video = $request->video;
        $data->save();
        if(!$data){
            return redirect()->back()->with('message','Please, try again!');
        }
        return redirect()->back()->with('message','Upload Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($postId,$id)
    {
        $data = PostVideoModel::find($id);
        $data->delete();
        return "Delete Successful!";
    }
}
