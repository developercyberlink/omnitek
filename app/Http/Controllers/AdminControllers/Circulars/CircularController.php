<?php

namespace App\Http\Controllers\AdminControllers\Circulars;

use App\Models\Circulars\CircularModel;
use App\Models\Circulars\CircularTypeModel;
use App\Models\Departments\DepartmentModel;
use App\Models\Members\MemberModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use Image;

class CircularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($typeId)
    {  
       $data = CircularModel::where('circular_type',$typeId)->get();
       return view('admin.circulars.index', compact('data'));
 }
 
  public function list($type)
    {  
        return "list";
        $_type = trim($type);
        $ct_id = $this->getCircularTypeId($_type);
        $data = CircularModel::where(['circular_type'=>$ct_id->id])->get();
        return view('admin.circulars.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($typeId)
    {     
    $department = DepartmentModel::all();
    $type = CircularTypeModel::all();
    return view('admin.circulars.create', compact('type','department'));
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
            'circular_title'=>'required',
            'uri'=>'required'
        ]);
        $large_width = env('LARGE_WIDTH');
        $large_height = env('LARGE_HEIGHT');

        $data = $request->all();
        $file =  $request->file('circular_thumbnail');
        $file_name = '';
         if($request->hasfile('circular_thumbnail')){
            $product = $request->file('circular_thumbnail')->getClientOriginalName();
            $extension = $request->file('circular_thumbnail')->getClientOriginalExtension();
            
            $product = explode('.', $product);
            $file_name = Str::slug($product[0]) . '-' . Str::random(40) . '.' . $extension;
            
            $destinationPath_large = public_path('uploads/large');

            $product_picture = Image::make($file->getRealPath());
        
            //  $width = Image::make($file->getRealPath())->width();
            // $height = Image::make($file->getRealPath())->height();

        $product_picture->resize($large_width, $large_height, function($constraint){
            $constraint->aspectRatio();
             })->save($destinationPath_large .'/'. $file_name );
        }

        $data['circular_type'] = $request->circular_type;
        $data['uri'] = Str::slug($request->uri); 
        $data['circular_thumbnail'] = $file_name;
        $data['department'] = serialize($request->department);
        // $data['members'] = implode(',',$request->user);
       // $data['members'] = serialize($request->user);
        $result = CircularModel::create($data);
        if($result){
            return redirect()->back()->with('message','Successfully added.');
        }else{
            return 'Error';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts\PostModel  $postModel
     * @return \Illuminate\Http\Response
     */
    public function show(CircularModel $circularModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posts\PostModel  $postModel
     * @return \Illuminate\Http\Response
     */
    public function edit(CircularModel $circularModel,$circulartype, $id)
    {
     $department = DepartmentModel::all();
     $data = CircularModel::find($id);
     return view('admin.circulars.edit', compact('data','department'));
 }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posts\PostModel  $postModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CircularModel $circularModel,$circulartype,$id)
    {      
         $request->validate([
            'circular_title'=>'required',
            'uri'=>'required'
        ]);

        $large_width = env('LARGE_WIDTH');
        $large_height = env('LARGE_HEIGHT');

        $data = CircularModel::find($id);  
        $file =  $request->file('circular_thumbnail');
        $product_name = '';
        if($request->hasfile('circular_thumbnail')){
            $data = CircularModel::find($id);  
            if($data->circular_thumbnail){
                 
                if(file_exists(public_path('public/uploads/large/' .  $data->circular_thumbnail))){
                    unlink('public/uploads/large/' . $data->circular_thumbnail);
                }
                   
            }
            $product = $request->file('circular_thumbnail')->getClientOriginalName();
            $extension = $request->file('circular_thumbnail')->getClientOriginalExtension();
            $product = explode('.', $product);
            $product_name = Str::slug($product[0]) . '-' . Str::random(40) . '.' . $extension;
            $destinationPath_large = public_path('uploads/large');
           
        $product_picture = Image::make($file->getRealPath());

        $product_picture->resize($large_width, $large_height, function($constraint){
            $constraint->aspectRatio();
             })->save($destinationPath_large .'/'. $product_name );

        $data->circular_thumbnail = $product_name;
        }    

        $data->circular_date = $request->circular_date;
        $data->circular_title = $request->circular_title;
        $data->sub_title = $request->sub_title;
        $data->circular_content = $request->circular_content;
        $data->circular_excerpt = $request->circular_excerpt;
        $data['department'] = serialize($request->department);
        // $data['members'] = implode(',',$request->user);
        $data->uri = Str::slug($request->uri);  
        $data->ordering = $request->ordering;
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
    public function destroy(CircularModel $circularModel, $circulartype, $id)
    {
        $data = CircularModel::find($id);
        if($data->circular_thumbnail  != NULL){
            unlink('uploads/large/' . $data->circular_thumbnail );
        }
       $data->delete();
        return 'Are you sure to delete?';
    }

    // Return Circular Type uri
    private function getCircularTypeId($uri){
        $circulartype = CircularTypeModel::where(['uri'=>$uri])->first();
        return $circulartype;
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

    // Remove Extention
    private function remove_extention($filename){
        $exp = explode('.',$filename);
        $file = $exp[0];
        return $file;
    }
    
      // Delete Post Thumbnail
     function delete_post_thumb(PostModel $postModel, $id){
         $data = PostModel::find($id);
         if($data->page_thumbnail){
                if(file_exists(public_path('uploads/ex_large/' .  $data->page_thumbnail))){
                    unlink('uploads/ex_large/' . $data->page_thumbnail);
                } 
                if(file_exists(public_path('uploads/large/' .  $data->page_thumbnail))){
                    unlink('uploads/large/' . $data->page_thumbnail);
                }
                if(file_exists(public_path('uploads/medium/' .  $data->page_thumbnail))){
                    unlink('uploads/medium/' . $data->page_thumbnail);
                }
                if(file_exists(public_path('uploads/original/' .  $data->page_thumbnail))){
                    unlink('uploads/original/' . $data->page_thumbnail);
                }
                if(file_exists(public_path('uploads/small/' .  $data->page_thumbnail))){
                    unlink('uploads/small/' . $data->page_thumbnail);
                }
                if(file_exists(public_path('uploads/thumbnail/' .  $data->page_thumbnail))){
                    unlink('uploads/thumbnail/' . $data->page_thumbnail);
                }     
            }
         $data->page_thumbnail = NULL;
         $data->save();
         return response('Delete Successful.');
    }
    
    public function listusers($dept){
        $data['users'] = MemberModel::where(['department'=>intval($dept)])->get();
        return $data;
    }
     
    public function departments(){
        $data['departments'] = DepartmentModel::all();
        return $data;
    }
    
    private function getCircular($param){
        $data = CircularTypeModel::where('uri',trim($param))->first();
        return $data;
    }
    
     // Delete Post Thumbnail
    public function delete_circular_thumb(CircularModel $circularModel, $id){
         $data = CircularModel::find($id);
         if($data->circular_thumbnail){
                 
                if(file_exists(public_path('uploads/large/' .  $data->circular_thumbnail))){
                    unlink('uploads/large/' . $data->circular_thumbnail);
                }
                    
            }
         $data->circular_thumbnail = NULL;
         $data->save();
         return response('Delete Successful.');
    }

}
