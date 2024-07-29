<?php

namespace App\Http\Controllers\AdminControllers\Posts;

use App\Models\Posts\PostTypeModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use Image;

class PostTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PostTypeModel::orderBy('ordering', 'asc')->get();
        return view('admin.post-type.index', compact('data'));
    }

    public function index_user()
    {
        $data = PostTypeModel::orderBy('ordering', 'asc')->get();
        return view('admin.post-type.user-index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // List Posttype Template
        $fileList = scandir(resource_path('views/themes/default/'));
        $filterArray = $this->filter_template_posttype($fileList);

        $filename = array();
        foreach ($filterArray as $filterArr) {
            $filename[] = $this->remove_extention($filterArr);
        }
        $file1 = array('page' => 'Choose Template');
        foreach ($filename as $file) {
            $file1[$file] = $file;
        }
        $templates = $file1;

        $ordering = PostTypeModel::max('ordering');
        $ordering = $ordering + 1;
        return view('admin.post-type.create', compact('ordering', 'templates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'post_type' => 'required',
            'uri' => 'required|unique:cl_post_type'
        ]);

        $medium_width = env('MEDIUM_WIDTH');
        $medium_height = env('MEDIUM_HEIGHT');
        $data = $request->all();

        $file = $request->file('banner');
        $banner = '';
        if ($request->hasfile('banner')) {
            $product = $request->file('banner')->getClientOriginalName();
            $extension = $request->file('banner')->getClientOriginalExtension();
            $product = explode('.', $product);
            $banner = Str::slug($product[0]) . '-' . Str::random(40) . '.' . $extension;

            $destinationPath_medium = public_path('uploads/medium');
            $destinationOriginal = public_path('uploads/original');

            $banner_picture = Image::make($file->getRealPath());
            $width = Image::make($file->getRealPath())->width();
            $height = Image::make($file->getRealPath())->height();

            $banner_picture->save($destinationOriginal . '/' . $banner);
            $banner_picture->resize($medium_width, $medium_height, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath_medium . '/' . $banner);

            /*Upload Original Image*/
            // $banner_picture->resize($width, $height, function($constraint){
            //   $constraint->aspectRatio();
            // })->save($destinationOriginal .'/'. $banner );
        }

        $data['banner'] = $banner;
        $data['content'] = $request->contents;
        $data['uri'] = Str::slug($request->uri);
        $result = PostTypeModel::create($data);
        if ($result) {
            return redirect()->back()->with('message', 'Stored Successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Posts\PostTypeModel $postTypeModel
     * @return \Illuminate\Http\Response
     */
    public function show(PostTypeModel $postTypeModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Posts\PostTypeModel $postTypeModel
     * @return \Illuminate\Http\Response
     */
    public function edit(PostTypeModel $postTypeModel, $posttype, $id)
    {

        // List Posttype Template
        $fileList = scandir(resource_path('views/themes/default/'));
        $filterArray = $this->filter_template_posttype($fileList);

        $filename = array();
        foreach ($filterArray as $filterArr) {
            $filename[] = $this->remove_extention($filterArr);
        }
        $file1 = array('page' => 'Choose Template');
        foreach ($filename as $file) {
            $file1[$file] = $file;
        }
        $templates = $file1;

        $data = PostTypeModel::find($id);
        return view('admin.post-type.edit', compact('data', 'templates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Posts\PostTypeModel $postTypeModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostTypeModel $postTypeModel, $posttype, $id)
    {
        $request->validate([
            'post_type' => 'required',
            'uri' => 'required'
        ]);
        $medium_width = env('MEDIUM_WIDTH');
        $medium_height = env('MEDIUM_HEIGHT');
        $data = PostTypeModel::find($id);
        $product_name = '';

        $file = $request->file('banner');

        if ($request->hasfile('banner')) {
            $data = PostTypeModel::find($id);
            if ($data->banner) {
                if (file_exists(env('PUBLIC_PATH') . 'uploads/medium/' . $data->banner)) {
                    unlink(env('PUBLIC_PATH') . 'uploads/medium/' . $data->banner);
                }
                if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->banner)) {
                    unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->banner);
                }
            }
            $product = $request->file('banner')->getClientOriginalName();
            $extension = $request->file('banner')->getClientOriginalExtension();
            $product = explode('.', $product);
            $product_name = Str::slug($product[0]) . '-' . Str::random(40) . '.' . $extension;

            $destinationPath_medium = public_path('uploads/medium');
            $destinationOriginal = public_path('uploads/original');

            $product_picture = Image::make($file->getRealPath());
            $width = Image::make($file->getRealPath())->width();
            $height = Image::make($file->getRealPath())->height();

            $product_picture->save($destinationOriginal . '/' . $product_name);
            $product_picture->resize($medium_width, $medium_height, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath_medium . '/' . $product_name);

            /*Upload Original Image*/
            // $product_picture->resize($width, $height, function($constraint){
            //   $constraint->aspectRatio();
            // })->save($destinationOriginal .'/'. $product_name );

            $data->banner = $product_name;
        }

        $data->post_type = $request->post_type;
        $data->caption = $request->caption;
        $data->meta_keyword = $request->meta_keyword;
        $data->meta_description = $request->meta_description;
        $data->content = $request->contents;
        $data->uri = Str::slug($request->uri);
        $data->template = $request->template;
        $data->uid = $request->uid;
        $data->ordering = $request->ordering;
        $data->is_menu = $request->is_menu;
        $data->save();
        return redirect()->back()->with('message', 'Update Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Posts\PostTypeModel $postTypeModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostTypeModel $postTypeModel, $posttype, $id)
    {
        $data = PostTypeModel::find($id);
        if ($data->banner) {
            if (file_exists(env('PUBLIC_PATH') . 'uploads/medium/' . $data->banner)) {
                unlink(env('PUBLIC_PATH') . 'uploads/medium/' . $data->banner);
            }
            if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->banner)) {
                unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->banner);
            }
        }
        $data->delete();
    }

    // Filter Template Child
    private function filter_template_posttype($template)
    {
        $tmpl2 = array();
        if (!empty($template)) {
            foreach ($template as $tmpl) {
                if (strpos($tmpl, "posttypeTemplate-") !== false) {
                    $tmpl2[] = $tmpl;
                }
            }
        }
        return $tmpl2;
    }

    // Remove Extention
    private function remove_extention($filename)
    {
        $exp = explode('.', $filename);
        $file = $exp[0];
        return $file;
    }

  // Delete PostType Thumbnail
    function delete_posttype_banner(PostTypeModel $postTypeModel, $id){
     $data = PostTypeModel::find($id);
     if ($data->banner) {
        if (file_exists(env('PUBLIC_PATH') . 'uploads/medium/' . $data->banner)) {
            unlink(env('PUBLIC_PATH') . 'uploads/medium/' . $data->banner);
        }
        if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->banner)) {
            unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->banner);
        }
    }
    $data->banner = NULL;
    $data->save();
    return response('Delete Successful.');
  }
}
