<?php

namespace App\Http\Controllers\AdminControllers\Portfolios;

use App\Models\Portfolios\PortfolioModel;
use App\Models\Portfolios\PortfolioCategoryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use Image;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
      //return redirect('admin/dashboard');
      $data = PortfolioModel::orderBy('ordering','asc')->get();
      return view('admin.portfolio.index', compact('data')); 
    }

    public function list($uri){

    }

    public function childlist($uri,$id){
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     
      $category = PortfolioCategoryModel::all();
       $ord = PortfolioModel::max('ordering');
      $ordering = $ord+1;
      return view('admin.portfolio.create', compact('category','ordering'));
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
        'title'=>'required',
        'uri'=>'required|unique:cl_portfolio'
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
      if($request->hasfile('icon')){       
        $_icon = $request->file('icon')->getClientOriginalName();
        $icon_extension = $request->file('icon')->getClientOriginalExtension();
        $_icon = explode('.', $_icon);
        $icon_name = Str::slug($_icon[0]) . '-' . Str::random(40) . '.' . $icon_extension;
        
        if($icon_extension != 'svg' && $icon_extension != 'webp'){
        $icon_picture = Image::make($icon->getRealPath());
        $width = Image::make($icon->getRealPath())->width();
        $height = Image::make($icon->getRealPath())->height();      
         /*Upload Original Image*/
        $icon_picture->save($destinationOriginal .'/'. $icon_name ); 
        $icon_picture->resize($medium_width, $medium_height, function($constraint){
          $constraint->aspectRatio();
        })->save($destinationPath_medium .'/'. $icon_name ); 

        }else{
          move_uploaded_file($_FILES["icon"]["tmp_name"], $destinationPath_medium.'/'.$icon_name);
        }
      }

      // Upload Thumbnail
      if($request->hasfile('thumbnail')){       
        $_thumbnail = $request->file('thumbnail')->getClientOriginalName();
        $thumbnail_extension = $request->file('thumbnail')->getClientOriginalExtension();
        $_thumbnail = explode('.', $_thumbnail);
        $thumbnail_name = Str::slug($_thumbnail[0]) . '-' . Str::random(40) . '.' . $thumbnail_extension;
        
        if($thumbnail_extension != 'svg' && $thumbnail_extension != 'webp'){
        $thumbnail_picture = Image::make($thumbnail->getRealPath());
        $width = Image::make($thumbnail->getRealPath())->width();
        $height = Image::make($thumbnail->getRealPath())->height();      
          /*Upload Original Image*/
        $thumbnail_picture->save($destinationOriginal .'/'. $thumbnail_name ); 
        $thumbnail_picture->resize($medium_width, $medium_height, function($constraint){
          $constraint->aspectRatio();
        })->save($destinationPath_medium .'/'. $thumbnail_name ); 

        }else{
          move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $destinationPath_medium.'/'.$thumbnail_name);
        }
      }

       // Upload Page Thumbnail
       if($request->hasfile('page_thumbnail')){       
        $_page_thumbnail = $request->file('page_thumbnail')->getClientOriginalName();
        $page_thumbnail_extension = $request->file('page_thumbnail')->getClientOriginalExtension();
        $_page_thumbnail = explode('.', $_page_thumbnail);
        $page_thumbnail_name = Str::slug($_page_thumbnail[0]) . '-' . Str::random(40) . '.' . $page_thumbnail_extension;
        
        if($page_thumbnail_extension != 'svg' && $page_thumbnail_extension != 'webp'){
        $page_thumbnail_picture = Image::make($page_thumbnail->getRealPath());
        $width = Image::make($page_thumbnail->getRealPath())->width();
        $height = Image::make($page_thumbnail->getRealPath())->height();      

        /*Upload Original Image*/
        $page_thumbnail_picture->save($destinationOriginal .'/'. $page_thumbnail_name ); 
        $page_thumbnail_picture->resize($medium_width, $medium_height, function($constraint){
          $constraint->aspectRatio();
        })->save($destinationPath_medium .'/'. $page_thumbnail_name ); 

        }else{
          move_uploaded_file($_FILES["page_thumbnail"]["tmp_name"], $destinationPath_medium.'/'.$page_thumbnail_name);
        }
      }

       // Upload Banner
       if($request->hasfile('banner')){       
        $_banner = $request->file('banner')->getClientOriginalName();
        $banner_extension = $request->file('banner')->getClientOriginalExtension();
        $_banner = explode('.', $_banner);
        $banner_name = Str::slug($_banner[0]) . '-' . Str::random(40) . '.' . $banner_extension;
        
        if($banner_extension != 'svg' && $banner_extension != 'webp'){
        $banner_picture = Image::make($banner->getRealPath());
        $width = Image::make($banner->getRealPath())->width();
        $height = Image::make($banner->getRealPath())->height();      
          /*Upload Original Image*/
        $banner_picture->save($destinationOriginal .'/'. $banner_name ); 
        $banner_picture->resize($medium_width, $medium_height, function($constraint){
          $constraint->aspectRatio();
        })->save($destinationPath_medium .'/'. $banner_name ); 

        }else{
          move_uploaded_file($_FILES["banner"]["tmp_name"], $destinationPath_medium.'/'.$banner_name);
        }
      }
      $data['uri'] = Str::slug($request->uri); 
      $data['thumbnail'] = $thumbnail_name;
      $data['page_thumbnail'] = $page_thumbnail_name;
      $data['icon'] = $icon_name;
      $data['banner'] = $banner_name;      
      $result = PortfolioModel::create($data);       
      $last_id = $result->id;
      if($result){
        return redirect( '/admin/our-trades/'.$last_id.'/edit')->with('message','Successfully added.');
      }else{
        return 'Error';
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolios\PortfoliosModel  $portfolioModel
     * @return \Illuminate\Http\Response
     */
    public function show(PortfolioModel $portfolioModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolios\PortfolioModel  $portfolioModel
     * @return \Illuminate\Http\Response
     */
    public function edit(PortfolioModel $portfolioModel, $id)
    {      
     $category = PortfolioCategoryModel::all();
     $data = PortfolioModel::find($id);
     return view('admin.portfolio.edit', compact('data','category'));
   }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolios\PortfolioModel  $portfolioModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PortfolioModel $portfolioModel, $id)
    {   
      $medium_width = env('MEDIUM_WIDTH');
      $medium_height = env('MEDIUM_HEIGHT');
      $destinationPath_medium = public_path('uploads/medium');
      $destinationOriginal = public_path('uploads/original');

      $data = PortfolioModel::find($id);  
      $thumbnail = $request->file('thumbnail');
      $page_thumbnail = $request->file('page_thumbnail');
      $banner = $request->file('banner');
      $icon = $request->file('icon');
      $thumbnail_name = '';
      $page_thumbnail_name = '';
      $banner_name = '';
      $icon_name = '';

      // Update Icon
      if($request->hasfile('icon')){  
        $data = PortfolioModel::find($id); 
        if($data->icon){
          if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->icon)){
            unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->icon);
          }
          if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->icon)){
            unlink(env('PUBLIC_PATH').'uploads/original/' . $data->icon);
          }
        }     
        $_icon = $request->file('icon')->getClientOriginalName();
        $icon_extension = $request->file('icon')->getClientOriginalExtension();
        $_icon = explode('.', $_icon);
        $icon_name = Str::slug($_icon[0]) . '-' . Str::random(40) . '.' . $icon_extension;
        
        if($icon_extension != 'svg' && $icon_extension != 'webp'){
        $icon_picture = Image::make($icon->getRealPath());
        $width = Image::make($icon->getRealPath())->width();
        $height = Image::make($icon->getRealPath())->height();      
         /*Upload Original Image*/
        $icon_picture->save($destinationOriginal .'/'. $icon_name ); 
        $icon_picture->resize($medium_width, $medium_height, function($constraint){
          $constraint->aspectRatio();
        })->save($destinationPath_medium .'/'. $icon_name ); 

        }else{
          move_uploaded_file($_FILES["icon"]["tmp_name"], $destinationPath_medium.'/'.$icon_name);
        }
        $data->icon = $icon_name;
      }

      // Update Thumbnail
      if($request->hasfile('thumbnail')){   
        $data = PortfolioModel::find($id); 
        if($data->thumbnail){
          if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail)){
            unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail);
          }
          if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->thumbnail)){
            unlink(env('PUBLIC_PATH').'uploads/original/' . $data->thumbnail);
          }
        }      
        $_thumbnail = $request->file('thumbnail')->getClientOriginalName();
        $thumbnail_extension = $request->file('thumbnail')->getClientOriginalExtension();
        $_thumbnail = explode('.', $_thumbnail);
        $thumbnail_name = Str::slug($_thumbnail[0]) . '-' . Str::random(40) . '.' . $thumbnail_extension;
       
        if($thumbnail_extension != 'svg' && $thumbnail_extension != 'webp'){
        $thumbnail_picture = Image::make($thumbnail->getRealPath());
        $width = Image::make($thumbnail->getRealPath())->width();
        $height = Image::make($thumbnail->getRealPath())->height();      
          /*Upload Original Image*/
        $thumbnail_picture->save($destinationOriginal .'/'. $thumbnail_name ); 
        $thumbnail_picture->resize($medium_width, $medium_height, function($constraint){
          $constraint->aspectRatio();
        })->save($destinationPath_medium .'/'. $thumbnail_name ); 

        }else{
          move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $destinationPath_medium.'/'.$thumbnail_name);
        }
        $data->thumbnail = $thumbnail_name;
      }

       // Update Page Thumbnail
       if($request->hasfile('page_thumbnail')){ 
        $data = PortfolioModel::find($id); 
        if($data->page_thumbnail){
          if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->page_thumbnail)){
            unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->page_thumbnail);
          }
          if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->page_thumbnail)){
            unlink(env('PUBLIC_PATH').'uploads/original/' . $data->page_thumbnail);
          }
        }           
        $_page_thumbnail = $request->file('page_thumbnail')->getClientOriginalName();
        $page_thumbnail_extension = $request->file('page_thumbnail')->getClientOriginalExtension();
        $_page_thumbnail = explode('.', $_page_thumbnail);
        $page_thumbnail_name = Str::slug($_page_thumbnail[0]) . '-' . Str::random(40) . '.' . $page_thumbnail_extension;
       
        if($page_thumbnail_extension != 'svg' && $page_thumbnail_extension != 'webp'){
        $page_thumbnail_picture = Image::make($page_thumbnail->getRealPath());
        $width = Image::make($page_thumbnail->getRealPath())->width();
        $height = Image::make($page_thumbnail->getRealPath())->height();      
          /*Upload Original Image*/
        $page_thumbnail_picture->save($destinationOriginal .'/'. $page_thumbnail_name ); 
        $page_thumbnail_picture->resize($medium_width, $medium_height, function($constraint){
          $constraint->aspectRatio();
        })->save($destinationPath_medium .'/'. $page_thumbnail_name ); 

        }else{
          move_uploaded_file($_FILES["page_thumbnail"]["tmp_name"], $destinationPath_medium.'/'.$page_thumbnail_name);
        }
        $data->page_thumbnail = $page_thumbnail_name;
      }

      // Update Banner
      if($request->hasfile('banner')){    
        $data = PortfolioModel::find($id); 
        if($data->banner){
          if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->banner)){
            unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->banner);
          }
          if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->banner)){
            unlink(env('PUBLIC_PATH').'uploads/original/' . $data->banner);
          }
        }    
        $_banner = $request->file('banner')->getClientOriginalName();
        $banner_extension = $request->file('banner')->getClientOriginalExtension();
        $_banner = explode('.', $_banner);
        $banner_name = Str::slug($_banner[0]) . '-' . Str::random(40) . '.' . $banner_extension;
        
        if($banner_extension != 'svg' && $banner_extension != 'webp'){
        $banner_picture = Image::make($banner->getRealPath());
        $width = Image::make($banner->getRealPath())->width();
        $height = Image::make($banner->getRealPath())->height();      
         /*Upload Original Image*/
        $banner_picture->save($destinationOriginal .'/'. $banner_name );
        $banner_picture->resize($medium_width, $medium_height, function($constraint){
          $constraint->aspectRatio();
        })->save($destinationPath_medium .'/'. $banner_name ); 
 
        }else{
          move_uploaded_file($_FILES["banner"]["tmp_name"], $destinationPath_medium.'/'.$banner_name);
        }
        $data->banner = $banner_name;
      }

      $data->title = $request->title;
      $data->uri = Str::slug($request->uri); 
      $data->sub_title = $request->sub_title;
      $data->content = $request->content;
      $data->brief = $request->brief;  
      $data->category_id = $request->category_id;
      $data->ordering = $request->ordering;       
      $data->meta_keyword = $request->meta_keyword;
      $data->meta_description = $request->meta_description;
      $data->external_link = $request->external_link;
      $data->client_name = $request->client_name;
      $data->country = $request->country;
      $data->service = $request->service;
      $data->year = $request->year;    
      if($data->save()){
        return redirect()->back()->with('message','Update Sucessfully.');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts\PostModel  $postModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(PortfolioModel $portfolioModel,$id)
    {
      $data = PortfolioModel::find($id);
      if($data->icon != NULL){
        if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->icon)){
          unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->icon);
        }
        if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->icon)){
          unlink(env('PUBLIC_PATH').'uploads/original/' . $data->icon);
        } 
      }
      if($data->thumbnail != NULL){
        if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail)){
          unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail);
        }
        if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->thumbnail)){
          unlink(env('PUBLIC_PATH').'uploads/original/' . $data->thumbnail);
        } 
      }
      if($data->page_thumbnail != NULL){
        if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->page_thumbnail)){
          unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->page_thumbnail);
        }
        if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->page_thumbnail)){
          unlink(env('PUBLIC_PATH').'uploads/original/' . $data->page_thumbnail);
        } 
      }
      if($data->banner != NULL){
        if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->banner)){
          unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->banner);
        }
        if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->banner)){
          unlink(env('PUBLIC_PATH').'uploads/original/' . $data->banner);
        } 
      }
      $data->delete();
      return 'Are you sure to delete?';
    }

    // Return Post Type uri
    private function getPostTypeId($uri){
      $posttype = PostTypeModel::where('uri',$uri)->first();
      return $posttype;
    }

    // Filter Template
    private function filter_template($template){
      $tmpl = array();
      if(!empty($template)){
        foreach($template as $tmp){
          if(strpos($tmp, "template-") !== false){
            $tmpl[] = $tmp;
          }   
        }
      }
      return $tmpl;
    }

    // Filter Template Child
    private function filter_template_child($template){
      $tmpl2 = array();
      if(!empty($template)){
        foreach($template as $tmpl){
          if(strpos($tmpl, "templatechild-") !== false){
            $tmpl2[] = $tmpl;
          }   
        }
      }
      return $tmpl2;
    }

     // Remove Extention
     private function remove_extention($filename){
      $exp = explode('.',$filename);
      $file = $exp[0];
      return $file;
    }

    // Delete Portfolio Icon
    function delete_picon(PortfolioModel $portfolioModel, $id){
          $data = PortfolioModel::find($id);
          if($data->icon){
           if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->icon)){
             unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->icon);
           }
           if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->icon)){
             unlink(env('PUBLIC_PATH').'uploads/original/' . $data->icon);
           }
         }
         $data->icon = NULL;
         $data->save();
         return response('Delete Successful.');
       }

    // Delete Portfolio Thumbnail
    function delete_pthumbnail(PortfolioModel $portfolioModel, $id){
     $data = PortfolioModel::find($id);
     if($data->thumbnail){
      if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail)){
        unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail);
      }
      if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->thumbnail)){
        unlink(env('PUBLIC_PATH').'uploads/original/' . $data->thumbnail);
      }
    }
    $data->thumbnail = NULL;
    $data->save();
    return response('Delete Successful.');
  }

  // Delete Portfolio Page Thumbnail
       function delete_portfolio_pthumb(PortfolioModel $portfolioModel, $id){
        $data = PortfolioModel::find($id);
        if($data->page_thumbnail){
         if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->page_thumbnail)){
           unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->page_thumbnail);
         }
         if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->page_thumbnail)){
           unlink(env('PUBLIC_PATH').'uploads/original/' . $data->page_thumbnail);
         }
       }
       $data->page_thumbnail = NULL;
       $data->save();
       return response('Delete Successful.');
     }

    // Delete Portfolio Icon
       function delete_pbanner(PortfolioModel $portfolioModel, $id){
        $data = PortfolioModel::find($id);
        if($data->banner){
         if(file_exists(env('PUBLIC_PATH').'uploads/medium/' . $data->banner)){
           unlink(env('PUBLIC_PATH').'uploads/medium/' . $data->banner);
         }
         if(file_exists(env('PUBLIC_PATH').'uploads/original/' . $data->banner)){
           unlink(env('PUBLIC_PATH').'uploads/original/' . $data->banner);
         }
       }
       $data->banner = NULL;
       $data->save();
       return response('Delete Successful.');
     }

  
}
