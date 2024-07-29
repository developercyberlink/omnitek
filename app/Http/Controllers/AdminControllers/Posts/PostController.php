<?php

namespace App\Http\Controllers\AdminControllers\Posts;

use App\Models\Posts\PostTypeModel;
use App\Models\Posts\PostModel;
use App\Models\Posts\PostCategoryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Image;

class PostController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index($uri)
  {
    $posttype = PostTypeModel::where('uri', $uri)->first();
    if ($posttype) {
      $posttypeId = $posttype->id;
      $data = PostModel::where(['post_type' => $posttypeId, 'post_parent' => 0])->orderBy('post_order', 'asc')->get();
      return view('admin.posts.index', compact('data'));
    }
    return redirect('/dashboard');
  }

  public function list($uri)
  {

    $posttype = PostTypeModel::where('uri', $uri)->first();
    if ($posttype) {
      $posttypeId = $posttype->id;
      $data = PostModel::where(['post_type' => $posttypeId, 'post_parent' => 0])->orderBy('post_order', 'asc')->get();
      return view('admin.posts.index', compact('data'));
    }
    return redirect('/dashboard');
  }

  public function childlist($uri, $id)
  {
    $posttype = PostTypeModel::where('uri', $uri)->first();
    if ($posttype) {
      $posttype_id = $posttype->id;
      $data = PostModel::where(['post_type' => $posttype_id, 'post_parent' => $id])->orderBy('post_order', 'asc')->get();
      return view('admin.posts.index', compact('data'));
    }
    return redirect('/dashboard');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    // List Template
    $fileList = scandir(resource_path('views/themes/default/'));
    $filterArray = $this->filter_template($fileList);

    $filename = array();
    foreach ($filterArray as $filterArr) {
      $filename[] = $this->remove_extention($filterArr);
    }
    $file1 = array('single' => 'Choose Template');
    foreach ($filename as $file) {
      $file1[$file] = $file;
    }
    $templates = $file1;

    // List Template Child
    $fileListChild = scandir(resource_path('views/themes/default/'));
    $filterArrayChild = $this->filter_template_child($fileListChild);
    $filenameChild = array();
    foreach ($filterArrayChild as $filterArrChild) {
      $filenameChild[] = $this->remove_extention($filterArrChild);
    }
    $file1Child = array('single' => 'Choose Child Template');
    foreach ($filenameChild as $fileChild) {
      $file1Child[$fileChild] = $fileChild;
    }
    $templates_child = $file1Child;

    // Get parent list by post type ID
    $posttype_uri = request()->segment(2);
    $posttype = $this->getPostTypeId($posttype_uri);
    $posttype_id = $posttype->id;
    $parent_post = PostModel::where(['post_type' => $posttype_id, 'post_parent' => 0])->get();
    $ord = PostModel::max('post_order');
    $post_order = $ord + 1;
    $category = PostCategoryModel::where('post_type', $posttype_id)->get();
    $publication = PostModel::where('post_type', 35)->get();
    //      dd($publication);
    return view('admin.posts.create', compact('publication', 'category', 'parent_post', 'templates', 'templates_child', 'post_order'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    if ($request->has('post_type')) {
      $post_type = $request->input('post_type');
    } else {
      return "Invalid Post Type";
    }

    $request->validate([
      'post_title' => 'required',
      'uri' => 'required|unique:cl_posts'
    ]);

    $medium_width = env('MEDIUM_WIDTH');
    $medium_height = env('MEDIUM_HEIGHT');
    $destinationPath_medium = public_path('uploads/medium');
    $destinationOriginal = public_path('uploads/original');

    $data = $request->all();
    $thumbnail =  $request->file('thumbnail');
    $page_thumbnail =  $request->file('page_thumbnail');
    $banner =  $request->file('banner');
    $icon =  $request->file('icon');
    $thumbnail_name = '';
    $page_thumbnail_name = '';
    $banner_name = '';
    $icon_name = '';

    // Upload Icon
    if ($request->hasfile('icon')) {
      $_icon = $request->file('icon')->getClientOriginalName();
      $icon_extension = $request->file('icon')->getClientOriginalExtension();
      $_icon = explode('.', $_icon);
      $icon_name = Str::slug($_icon[0]) . '-' . Str::random(40) . '.' . $icon_extension;

      if ($icon_extension != 'svg' && $icon_extension != 'webp') {
        $icon_picture = Image::make($icon->getRealPath());
        $width = Image::make($icon->getRealPath())->width();
        $height = Image::make($icon->getRealPath())->height();

        /*Upload Original Image*/
        $icon_picture->save($destinationOriginal . '/' . $icon_name);
        $icon_picture->resize($medium_width, $medium_height, function ($constraint) {
          $constraint->aspectRatio();
        })->save($destinationPath_medium . '/' . $icon_name);
      } else {
        move_uploaded_file($_FILES["icon"]["tmp_name"], $destinationPath_medium . '/' . $icon_name);
      }
    }

    // Upload Thumbnail
    if ($request->hasfile('thumbnail')) {
      $_thumbnail = $request->file('thumbnail')->getClientOriginalName();
      $thumbnail_extension = $request->file('thumbnail')->getClientOriginalExtension();
      $_thumbnail = explode('.', $_thumbnail);
      $thumbnail_name = Str::slug($_thumbnail[0]) . '-' . Str::random(40) . '.' . $thumbnail_extension;

      if ($thumbnail_extension != 'svg' && $thumbnail_extension != 'webp') {
        $thumbnail_picture = Image::make($thumbnail->getRealPath());
        $width = Image::make($thumbnail->getRealPath())->width();
        $height = Image::make($thumbnail->getRealPath())->height();
        /*Upload Original Image*/
        $thumbnail_picture->save($destinationOriginal . '/' . $thumbnail_name);
        $thumbnail_picture->resize($medium_width, $medium_height, function ($constraint) {
          $constraint->aspectRatio();
        })->save($destinationPath_medium . '/' . $thumbnail_name);
      } else {
        move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $destinationPath_medium . '/' . $thumbnail_name);
      }
    }

    // Upload Page Thumbnail
    if ($request->hasfile('page_thumbnail')) {
      $_page_thumbnail = $request->file('page_thumbnail')->getClientOriginalName();
      $page_thumbnail_extension = $request->file('page_thumbnail')->getClientOriginalExtension();
      $_page_thumbnail = explode('.', $_page_thumbnail);
      $page_thumbnail_name = Str::slug($_page_thumbnail[0]) . '-' . Str::random(40) . '.' . $page_thumbnail_extension;

      if ($page_thumbnail_extension != 'svg' && $page_thumbnail_extension != 'webp') {
        $page_thumbnail_picture = Image::make($page_thumbnail->getRealPath());
        $width = Image::make($page_thumbnail->getRealPath())->width();
        $height = Image::make($page_thumbnail->getRealPath())->height();
        /*Upload Original Image*/
        $page_thumbnail_picture->save($destinationOriginal . '/' . $page_thumbnail_name);
        $page_thumbnail_picture->resize($medium_width, $medium_height, function ($constraint) {
          $constraint->aspectRatio();
        })->save($destinationPath_medium . '/' . $page_thumbnail_name);
      } else {
        move_uploaded_file($_FILES["page_thumbnail"]["tmp_name"], $destinationPath_medium . '/' . $page_thumbnail_name);
      }
    }

    // Upload Banner
    if ($request->hasfile('banner')) {
      $_banner = $request->file('banner')->getClientOriginalName();
      $banner_extension = $request->file('banner')->getClientOriginalExtension();
      $_banner = explode('.', $_banner);
      $banner_name = Str::slug($_banner[0]) . '-' . Str::random(40) . '.' . $banner_extension;

      if ($banner_extension != 'svg' && $banner_extension != 'webp') {
        $banner_picture = Image::make($banner->getRealPath());
        $width = Image::make($banner->getRealPath())->width();
        $height = Image::make($banner->getRealPath())->height();
        /*Upload Original Image*/
        $banner_picture->save($destinationOriginal . '/' . $banner_name);
        $banner_picture->resize($medium_width, $medium_height, function ($constraint) {
          $constraint->aspectRatio();
        })->save($destinationPath_medium . '/' . $banner_name);

        /*Upload Original Image*/
        // $banner_picture->resize($width, $height, function($constraint){
        //   $constraint->aspectRatio();
        // })->save($destinationOriginal .'/'. $banner_name );
      } else {
        move_uploaded_file($_FILES["banner"]["tmp_name"], $destinationPath_medium . '/' . $banner_name);
      }
    }

    $data['page_key'] = time() . rand(500000, 999999999);
    $posttypeId = $this->getPostTypeId($request->post_type);
    $data['post_type'] = $posttypeId->id;
    if ($request->uri != NULL) {
      $data['uri'] = Str::slug($request->uri);
    } else {
      $data['uri'] = $data['page_key'];
    }
    $data['thumbnail'] = $thumbnail_name;
    $data['page_thumbnail'] = $page_thumbnail_name;
    $data['icon'] = $icon_name;
    $data['banner'] = $banner_name;
    $isChecked = $request->has('show_in_home');
    $data['show_in_home'] = ($isChecked) ? '1' : '0';

    $data['job_category'] =  $request->job_category;
    $data['employment_type'] =  $request->employment_type;
    $data['deadline'] = $request->deadline;
    $data['no_of_vacancy'] = $request->no_of_vacancy;

    $result = PostModel::create($data);
    $last_id = $result->id;
    $_data = PostModel::find($last_id);
    if ($request->publication) {
      $_data->related_publications()->attach($request->publication);
    }

    if ($result) {
      return redirect('admin/' . $post_type . '/' . $last_id . '/edit')->with('message', 'Successfully added.');
    } else {
      return 'Error';
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Posts\PostModel  $postModel
   * @return \Illuminate\Http\Response
   */
  public function show(PostModel $postModel)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Posts\PostModel  $postModel
   * @return \Illuminate\Http\Response
   */
  public function edit(PostModel $postModel, $posttype, $id)
  {
    $fileList = scandir(resource_path('views/themes/default/'));
    $filterArray = $this->filter_template($fileList);

    $filename = array();
    foreach ($filterArray as $filterArr) {
      $filename[] = $this->remove_extention($filterArr);
    }
    $file1 = array('single' => 'Choose Template');
    foreach ($filename as $key => $file) {
      $file1[$file] = $file;
    }
    $templates = $file1;

    // List Template Child
    $fileListChild = scandir(resource_path('views/themes/default/'));
    $filterArrayChild = $this->filter_template_child($fileListChild);

    $filenameChild = array();
    foreach ($filterArrayChild as $filterArrChild) {
      $filenameChild[] = $this->remove_extention($filterArrChild);
    }
    $file1Child = array('single' => 'Choose Child Template');
    foreach ($filenameChild as $fileChild) {
      $file1Child[$fileChild] = $fileChild;
    }
    $templates_child = $file1Child;

    // Get parent list by post type ID
    $posttype_uri = request()->segment(2);
    $posttype = $this->getPostTypeId($posttype_uri);
    $posttype_id = $posttype->id;
    $parent_post = PostModel::where(['post_type' => $posttype_id, 'post_parent' => 0])->get();
    $category = PostCategoryModel::where('post_type', $posttype_id)->get();
    $publication = PostModel::where('post_type', 35)->get();
    $post = PostModel::all();

    $data = PostModel::find($id);
    return view('admin.posts.edit', compact('post', 'publication', 'data', 'parent_post', 'templates', 'templates_child', 'category'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Posts\PostModel  $postModel
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, PostModel $postModel, $posttype, $id)
  {
    $request->validate([
      'post_title' => 'required',
    ]);

    $medium_width = env('MEDIUM_WIDTH');
    $medium_height = env('MEDIUM_HEIGHT');
    $destinationPath_medium = public_path('uploads/medium');
    $destinationOriginal = public_path('uploads/original');

    $data = PostModel::find($id);
    $thumbnail = $request->file('thumbnail');
    $page_thumbnail = $request->file('page_thumbnail');
    $banner = $request->file('banner');
    $icon = $request->file('icon');
    $thumbnail_name = '';
    $page_thumbnail_name = '';
    $banner_name = '';
    $icon_name = '';

    // Update Icon
    if ($request->hasfile('icon')) {
      $data = PostModel::find($id);
      if ($data->icon) {
        if (file_exists(env('PUBLIC_PATH') . 'uploads/medium/' . $data->icon)) {
          unlink(env('PUBLIC_PATH') . 'uploads/medium/' . $data->icon);
        }
        if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->icon)) {
          unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->icon);
        }
      }
      $_icon = $request->file('icon')->getClientOriginalName();
      $icon_extension = $request->file('icon')->getClientOriginalExtension();
      $_icon = explode('.', $_icon);
      $icon_name = Str::slug($_icon[0]) . '-' . Str::random(40) . '.' . $icon_extension;

      if ($icon_extension != 'svg' && $icon_extension != 'webp') {
        $icon_picture = Image::make($icon->getRealPath());
        $width = Image::make($icon->getRealPath())->width();
        $height = Image::make($icon->getRealPath())->height();
        /*Upload Original Image*/
        $icon_picture->save($destinationOriginal . '/' . $icon_name);
        $icon_picture->resize($medium_width, $medium_height, function ($constraint) {
          $constraint->aspectRatio();
        })->save($destinationPath_medium . '/' . $icon_name);
      } else {
        move_uploaded_file($_FILES["icon"]["tmp_name"], $destinationPath_medium . '/' . $icon_name);
      }
      $data->icon = $icon_name;
    }

    // Update Thumbnail
    if ($request->hasfile('thumbnail')) {
      $data = PostModel::find($id);
      if ($data->thumbnail) {
        if (file_exists(env('PUBLIC_PATH') . 'uploads/medium/' . $data->thumbnail)) {
          unlink(env('PUBLIC_PATH') . 'uploads/medium/' . $data->thumbnail);
        }
        if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->thumbnail)) {
          unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->thumbnail);
        }
      }
      $_thumbnail = $request->file('thumbnail')->getClientOriginalName();
      $thumbnail_extension = $request->file('thumbnail')->getClientOriginalExtension();
      $_thumbnail = explode('.', $_thumbnail);
      $thumbnail_name = Str::slug($_thumbnail[0]) . '-' . Str::random(40) . '.' . $thumbnail_extension;

      if ($thumbnail_extension != 'svg' && $thumbnail_extension != 'webp') {
        $thumbnail_picture = Image::make($thumbnail->getRealPath());
        $width = Image::make($thumbnail->getRealPath())->width();
        $height = Image::make($thumbnail->getRealPath())->height();
        /*Upload Original Image*/
        $thumbnail_picture->save($destinationOriginal . '/' . $thumbnail_name);
        $thumbnail_picture->resize($medium_width, $medium_height, function ($constraint) {
          $constraint->aspectRatio();
        })->save($destinationPath_medium . '/' . $thumbnail_name);
      } else {
        move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $destinationPath_medium . '/' . $thumbnail_name);
      }
      $data->thumbnail = $thumbnail_name;
    }

    // Update Page Thumbnail
    if ($request->hasfile('page_thumbnail')) {
      $data = PostModel::find($id);
      if ($data->page_thumbnail) {
        if (file_exists(env('PUBLIC_PATH') . 'uploads/medium/' . $data->page_thumbnail)) {
          unlink(env('PUBLIC_PATH') . 'uploads/medium/' . $data->page_thumbnail);
        }
        if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->page_thumbnail)) {
          unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->page_thumbnail);
        }
      }
      $_page_thumbnail = $request->file('page_thumbnail')->getClientOriginalName();
      $page_thumbnail_extension = $request->file('page_thumbnail')->getClientOriginalExtension();
      $_page_thumbnail = explode('.', $_page_thumbnail);
      $page_thumbnail_name = Str::slug($_page_thumbnail[0]) . '-' . Str::random(40) . '.' . $page_thumbnail_extension;

      if ($page_thumbnail_extension != 'svg' && $page_thumbnail_extension != 'webp') {
        $page_thumbnail_picture = Image::make($page_thumbnail->getRealPath());
        $width = Image::make($page_thumbnail->getRealPath())->width();
        $height = Image::make($page_thumbnail->getRealPath())->height();
        /*Upload Original Image*/
        $page_thumbnail_picture->save($destinationOriginal . '/' . $page_thumbnail_name);
        $page_thumbnail_picture->resize($medium_width, $medium_height, function ($constraint) {
          $constraint->aspectRatio();
        })->save($destinationPath_medium . '/' . $page_thumbnail_name);
      } else {
        move_uploaded_file($_FILES["page_thumbnail"]["tmp_name"], $destinationPath_medium . '/' . $page_thumbnail_name);
      }
      $data->page_thumbnail = $page_thumbnail_name;
    }

    // Update Banner
    if ($request->hasfile('banner')) {
      $data = PostModel::find($id);
      if ($data->banner) {
        if (file_exists(env('PUBLIC_PATH') . 'uploads/medium/' . $data->banner)) {
          unlink(env('PUBLIC_PATH') . 'uploads/medium/' . $data->banner);
        }
        if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->banner)) {
          unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->banner);
        }
      }
      $_banner = $request->file('banner')->getClientOriginalName();
      $banner_extension = $request->file('banner')->getClientOriginalExtension();
      $_banner = explode('.', $_banner);
      $banner_name = Str::slug($_banner[0]) . '-' . Str::random(40) . '.' . $banner_extension;

      if ($banner_extension != 'svg' && $banner_extension != 'webp') {
        $banner_picture = Image::make($banner->getRealPath());
        $width = Image::make($banner->getRealPath())->width();
        $height = Image::make($banner->getRealPath())->height();
        /*Upload Original Image*/
        $banner_picture->save($destinationOriginal . '/' . $banner_name);
        $banner_picture->resize($medium_width, $medium_height, function ($constraint) {
          $constraint->aspectRatio();
        })->save($destinationPath_medium . '/' . $banner_name);

        /*Upload Original Image*/
        // $banner_picture->resize($width, $height, function($constraint){
        //   $constraint->aspectRatio();
        // })->save($destinationOriginal .'/'. $banner_name );
      } else {
        move_uploaded_file($_FILES["banner"]["tmp_name"], $destinationPath_medium . '/' . $banner_name);
      }
      $data->banner = $banner_name;
    }

    $posttypeId = $this->getPostTypeId($request->post_type);
    $data->post_date = $request->post_date;
    $data->template = $request->template;
    $data->template_child = $request->template_child;
    $data->post_title = $request->post_title;
    if ($request->uri != NULL) {
      $data['uri'] = Str::slug($request->uri);
    } else {
      $data['uri'] = $data->page_key;
    }
    $data->sub_title = $request->sub_title;
    $data->uid = $request->uid;
    $data->post_content = $request->post_content;
    $data->post_excerpt = $request->post_excerpt;
    $data->post_type = $posttypeId->id;
    $data->post_category = $request->category;
    $data->post_parent = $request->post_parent;
    $data->post_order = $request->post_order;
    $data->page_video = $request->page_video;
    $data->meta_keyword = $request->meta_keyword;
    $data->meta_description = $request->meta_description;
    $data->associated_title = $request->associated_title;
    $data->external_link = $request->external_link;
    $data->price = $request->price;
    $data->post_tags = $request->post_tags;
    $data->project_status = $request->project_status;
    $isChecked = $request->has('show_in_home');
    $data->show_in_home = ($isChecked) ? '1' : '0';
    $data->home_order = $request->home_order;
    $pub = $request->publication;

    $data->job_category =  $request->job_category;
    $data->employment_type =  $request->employment_type;
    $data->deadline = $request->deadline;
    $data->no_of_vacancy = $request->no_of_vacancy;
    if ($request->publication) {
      ////             $data->related_publications()->detach();
      //             $data->related_publications()->attach($request->publication);
      $data->related_publications()->sync($pub);
    }

    if ($data->save()) {
      return redirect()->back()->with('message', 'Update Sucessfully.');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Posts\PostModel  $postModel
   * @return \Illuminate\Http\Response
   */
  public function destroy(PostModel $postModel, $posttype, $id)
  {
    $data = PostModel::find($id);
    $data->related_publications()->detach();
    if ($data->icon != NULL) {
      if (file_exists(env('PUBLIC_PATH') . 'uploads/medium/' . $data->icon)) {
        unlink(env('PUBLIC_PATH') . 'uploads/medium/' . $data->icon);
      }
      if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->icon)) {
        unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->icon);
      }
    }
    if ($data->thumbnail != NULL) {
      if (file_exists(env('PUBLIC_PATH') . 'uploads/medium/' . $data->thumbnail)) {
        unlink(env('PUBLIC_PATH') . 'uploads/medium/' . $data->thumbnail);
      }
      if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->thumbnail)) {
        unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->thumbnail);
      }
    }
    if ($data->page_thumbnail != NULL) {
      if (file_exists(env('PUBLIC_PATH') . 'uploads/medium/' . $data->page_thumbnail)) {
        unlink(env('PUBLIC_PATH') . 'uploads/medium/' . $data->page_thumbnail);
      }
      if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->page_thumbnail)) {
        unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->page_thumbnail);
      }
    }
    if ($data->banner != NULL) {
      if (file_exists(env('PUBLIC_PATH') . 'uploads/medium/' . $data->banner)) {
        unlink(env('PUBLIC_PATH') . 'uploads/medium/' . $data->banner);
      }
      if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->banner)) {
        unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->banner);
      }
    }
    $data->delete();
    return 'Are you sure to delete?';
  }

  // Return Post Type uri
  private function getPostTypeId($uri)
  {
    $posttype = PostTypeModel::where('uri', $uri)->first();
    return $posttype;
  }

  // Filter Template
  private function filter_template($template)
  {
    $tmpl = array();
    if (!empty($template)) {
      foreach ($template as $tmp) {
        if (strpos($tmp, "template-") !== false) {
          $tmpl[] = $tmp;
        }
      }
    }
    return $tmpl;
  }

  // Filter Template Child
  private function filter_template_child($template)
  {
    $tmpl2 = array();
    if (!empty($template)) {
      foreach ($template as $tmpl) {
        if (strpos($tmpl, "templatechild-") !== false) {
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

  // Delete Post Thumbnail
  function delete_pagethumbnail(PostModel $postModel, $id)
  {
    $data = PostModel::find($id);
    if ($data->page_thumbnail) {
      if (file_exists(env('PUBLIC_PATH') . 'uploads/medium/' . $data->page_thumbnail)) {
        unlink(env('PUBLIC_PATH') . 'uploads/medium/' . $data->page_thumbnail);
      }
      if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->page_thumbnail)) {
        unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->page_thumbnail);
      }
    }
    $data->page_thumbnail = NULL;
    $data->save();
    return response('Delete Successful.');
  }

  // Delete Post Thumbnail
  function delete_icon(PostModel $postModel, $id)
  {
    $data = PostModel::find($id);
    if ($data->icon) {
      if (file_exists(env('PUBLIC_PATH') . 'uploads/medium/' . $data->icon)) {
        unlink(env('PUBLIC_PATH') . 'uploads/medium/' . $data->icon);
      }
      if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->icon)) {
        unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->icon);
      }
    }
    $data->icon = NULL;
    $data->save();
    return response('Delete Successful.');
  }

  // Delete Post Thumbnail
  function delete_thumbnail(PostModel $postModel, $id)
  {
    $data = PostModel::find($id);
    if ($data->thumbnail) {
      if (file_exists(env('PUBLIC_PATH') . 'uploads/medium/' . $data->thumbnail)) {
        unlink(env('PUBLIC_PATH') . 'uploads/medium/' . $data->thumbnail);
      }
      if (file_exists(env('PUBLIC_PATH') . 'uploads/original/' . $data->thumbnail)) {
        unlink(env('PUBLIC_PATH') . 'uploads/original/' . $data->thumbnail);
      }
    }
    $data->thumbnail = NULL;
    $data->save();
    return response('Delete Successful.');
  }

  // Delete Post Thumbnail
  function delete_banner(PostModel $postModel, $id)
  {
    $data = PostModel::find($id);
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

  public function poststatus($id)
  {
    $data = PostModel::find($id);
    if ($data->status == '1') {
      $data->status = '0';
      $data->save();
      return 'Success';
    } else if ($data->status == '0') {
      $data->status = '1';
      $data->save();
      return 'Success';
    }
    return 'Not success';
  }

  public function globalpost($id)
  {
    $data = PostModel::find($id);
    if ($data->global_post == '1') {
      $data->global_post = '0';
      $data->save();
      return 'Success';
    } else if ($data->global_post == '0') {
      $data->global_post = '1';
      $data->save();
      return 'Success';
    }
    return 'Not success';
  }
}
