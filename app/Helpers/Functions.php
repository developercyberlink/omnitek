<?php
use App\Models\Posts\PostCategoryModel;
use App\Models\Posts\PostModel;
use App\Models\Posts\PostTypeModel;
use App\Models\Galleries\ImageGalleryCategoryModel;
use App\Models\Galleries\ImageGalleryModel;
use App\Models\Galleries\VideoGalleryModel;
use App\Models\Tenders\VenderModel;
use App\Models\Circulars\CircularModel;
use App\Models\Posts\PostImageModel;
use App\Models\Members\MemberModel;
use App\Models\Settings\SettingModel;
use App\Models\Settings\CountryModel;
use App\Models\Portfolios\PortfolioModel;
use App\Models\AdminMenu\AdminMenuUserModel;
use App\Models\Posts\AssociatedPostModel;
use App\User;

// Check whether this post type has post or not.
function is_empty_posttype($id){
  $data = PostModel::where(['post_type'=>$id])->count();
  if( $data > 0){
    return true;
  }
  return false;
}

function is_empty_circular_type($id){
  $data = CircularModel::where(['circular_type'=>$id])->count();
  if( $data > 0){
    return true;
  }
  return false;
}

// Check whether this category has post or not.
function is_empty_category($id){
  $data = PostModel::where(['post_category'=>$id])->count();
  if( $data > 0){
    return true;
  }
  return false;
}
function check_associated_post($id){
  $data = AssociatedPostModel::where('post_id',$id)->count();
  return $data;
}

function show_category($category_id){
	$post = PostCategoryModel::where('id',$category_id)->first();
   if($post){
  return $post['category'];
}
  return false;
}


function loop_category($id){
	$category = PostCategoryModel::where('id',$id)->first();
   if($category){
    return $category;
  }
  return false;
}


function has_posts($post_type){
  $data = PostModel::where(['post_type'=>$post_type,'post_parent'=>'0','status'=>1])->orderBy('post_order','asc')->get();
  if($data->count() > 1){
    return $data;
  }
  return false;
}

function has_single_post($post_type){
  $data = PostModel::where(['post_type'=>$post_type,'post_parent'=>'0','status'=>1])->orderBy('post_order','asc')->first();
  if($data){
    return $data;
  }
  return false;
}

function check_uri($uri){
     $data = PostModel::where(['uri'=>$uri])->first();
     if($data){
      return true;
     }else{
       $page_key = PostModel::where(['page_key'=>$uri])->first();
       if($page_key){
            return true;
       }
     }
     return false;
}

function check_posttype_uri($uri){
  $data = PostTypeModel::where(['uri'=>$uri])->first();
  if($data){
   return true;
  }
  return false;
}

// function geturl($uri=null){
//   $count = PostModel::where(['uri'=>$uri])->count();
//   $data = PostModel::where(['page_key'=>$uri])->first();
//   if($uri){
//         if($count > 1 || $data['uri'] == NULL){
//         return $data['page_key'].'.html';
//     }
//   }
//   return $data['uri'].'.html';
// }

function geturl($uri=NULL,$page_key=NULL){
     $count = PostModel::where(['uri'=>$uri])->count();
     $data = PostModel::where(['uri'=>$uri])->firstOrFail();
      if($count > 1 || $uri === NULL || $uri === ""){
            $count = PostModel::where(['page_key'=>$page_key])->count();
            $data = PostModel::where(['page_key'=>$page_key])->firstOrFail();
            return $data->page_key.'.html';
      }
    return $data->uri.'.html';
}

function posttype_url($uri){
  $count = PostTypeModel::where(['uri'=>$uri])->count();
  $data = PostTypeModel::where(['uri'=>$uri])->first();
  if($count > 1){
    return $data->page_key.'.html';
  }
 return $data->uri.'.html';
}

// Check and List Child Post
function has_child_post($id){
  $check_child = PostModel::where(['post_parent'=>$id])->count();
  $data = PostModel::where(['post_parent'=>$id,'status'=>'1'])->orderBy('post_order','asc')->get();
  if($data->count() > 0){
    return $data;
  }
  return false;
}

function check_child_post($id){
	$data = PostModel::where('post_parent',$id)->count();
	return $data;
}

function photo_category(){
	$data = ImageGalleryCategoryModel::all();
	return $data;
}

function video_gallery(){
	$data = VideoGalleryModel::paginate(15);
	return $data;
}

// Get parent post
function post_parent($uri){
  $post = PostModel::where(['uri'=>$uri])->first();
  if($post->post_parent){
   $parent = PostModel::where(['id'=>$post->post_parent,'status'=>1])->first();
   return $parent;
 }
 return false;
}

// Get parent category name
function get_parent_name($id){
    $post = PostModel::where(['id'=>$id])->first();
    if($post->post_parent){
        $parent = PostModel::where(['id'=>$post->post_parent,'status'=>1])->first();
        return $parent;
    }
    return false;
}

// Associated Post
function associated_posts($id){
  $post = AssociatedPostModel::where('post_id',$id)->get();
  if($post){
   return $post;
 }
 return false;
}

// Get parent post
function post_doctor_byId($id){
  $parent = PostModel::where(['id'=>intval($id)])->first();
  if($parent){
   return $parent['post_title'];
 }
 return false;
}

// Get Doctor
function post_parent_byId($id){
  $parent = PostModel::where(['id'=>intval($id)])->first();
  if($parent){
   return $parent;
 }
 return false;
}

// for sidebar inner left
function child_list($uri){
 $post_parent = PostModel::where(['uri'=>$uri, 'status'=>1])->first();
 if($post_parent->post_parent){
   $_list = PostModel::where(['post_parent'=>$post_parent->post_parent,'status'=>1])->get();
   return $_list;
 }
 return false;
}

function child_listById($id){
  return $id;
  $post_parent = PostModel::where(['id'=>$id, 'status'=>1])->first();
  if($post_parent->post_parent){
    $_list = PostModel::where(['post_parent'=>$post_parent->post_parent,'status'=>1])->get();
    return $_list;
  }
  return false;
 }

function multiple_image($postid){
 $data = PostImageModel::where(['post_id'=>$postid])->get();
 if($data->count() > 0 ){
   return $data;
 }
 return false;
}

function find_employee($customer_id){
 $data = MemberModel::where(['id'=>$customer_id])->first();
 if($data){
   return $data;
 }
 return false;
}

function settings(){
 $data = SettingModel::where(['id'=>'1'])->first();
 if($data){
   return $data;
 }
 return false;
}

function countries(){
  $data = CountryModel::all();
  return $data;
}

function posttype($uri){
  $data = PostTypeModel::where('uri',$uri)->first();
  return $data;
}

function posttypeById($id){
  $data = PostTypeModel::where('id',$id)->first();
  return $data;
}

function getposts($id){
  $data = PostModel::where(['post_type'=>$id,'post_parent'=>'0','status'=>'1'])->orderBy('post_order','asc')->get();
  return $data;
}

function getcategories($post_type){
  $data = PostCategoryModel::where('post_type',$post_type)->orderBy('ordering','asc')->get();
  if($data->count() > 0){
    $li = '';
  foreach($data as $row){
        $li .= '<li>
              <h2 class="page-list-title"><a href="/service-category/'.getcategory_url($row->uri).'">'. $row->category .'</a></h2>
              <ul>' .
              getPostByCagtegory($row->id) .
              '</ul>';
              if(postCount($row->id) > 5){
               $li .= '<div class="button-text">
                      <a href="/service-category/'.getcategory_url($row->uri).'" class="btn-text">
                              View All
                               <span class="button-icon ml-1">
                               <i class="far fa-long-arrow-right"></i>
                            </span>
                            </a>
                      </div>';
              }
        $li .= '</li>';
    }
    return $li;
    }
  }

  function postCount($catId){
    $data = PostModel::where('post_category',$catId)->count();
    return $data;
  }

  function getcategory_url($uri){
    $data = PostCategoryModel::where(['uri'=>$uri])->get();
     if($data->count() > 0 ){
           $data = PostCategoryModel::where(['uri'=>$uri])->first();
           return $data->uri.'.html';
     }
     return false;
  }

function getPostByCagtegory($catId){
 $data = PostModel::where('post_category',$catId)->orderBy('post_order')->get();
 if($data->count() > 0){
   $li = '';
   foreach($data as $row){
      $li .= '<li><a href="'.url('/services/'.geturl($row->uri)).'"><span>'.$row->post_title.'</span></a></li>';
   }
   return $li;
 }
}

// Footer Menu
function footerMenu($post_type){
  $data = PostCategoryModel::where('post_type',$post_type)->orderBy('ordering','asc')->get();
  if($data->count() > 0){
    $li = '';
  foreach($data as $row){
    $_data = PostModel::where('post_category',$row->id)->orderBy('post_order')->get();
        $li .= '<div class="col-lg-4 col-md-6 col-sm-6 footer-widget">';
        $li .= '<ul class="footer-widget__list">';
        foreach($_data as $_row){
          $li .= '<li><a href="'.url('/services/'.geturl($_row->uri)).'" class="hover-style-link"><span>'. $_row->post_title .'</span></a></li>';
        }
        $li .= '</ul></div>';
      }
    return $li;
  }
}

// Footer Menu Mobile
function footerMenuMobile($post_type){
  $data = PostCategoryModel::where('post_type',$post_type)->orderBy('ordering','asc')->get();
  if($data->count() > 0){
    $li = '';
  foreach($data as $row){
    $_data = PostModel::where('post_category',$row->id)->orderBy('post_order')->get();
        $li .= '<li class="has-children">';
        $li .= '<a href="#">'.$row->category.'</a>';
        $li .= '<ul class="sub-menu">';
        foreach($_data as $_row){
        $li .= '<li><a href="'.url('/services/'.geturl($_row->uri)).'"><span>'. $_row->post_title .'</span></a></li>';
        }
        $li .= '</ul></li>';
      }
    return $li;
  }
}

function portfolio_count($catId){
  $data = PortfolioModel::where('category_id',$catId)->get();
  return $data->count();
}

function viewsIndicator($views){

    if($views > 1000){
      return '<span class="badge badge-success badge-pill"><i class="fa fa-eye"></i> '. $views/1000 .'K+ </span>';
    }

    if($views == 1000){
      return '<span class="badge badge-success badge-pill"><i class="fa fa-eye"></i> '. $views/1000 .'K </span>';
    }

    if($views < 1000 && $views >= 500){
      return '<span class="badge badge-primary badge-pill"><i class="fa fa-eye"></i> '. $views .' </span>';
    }

    if($views < 500 && $views >= 100){
      return '<span class="badge badge-info badge-pill"><i class="fa fa-eye"></i> '. $views .' </span>';
    }

    if($views < 100){
      return '<span class="badge badge-warning badge-pill"><i class="fa fa-eye"></i> '. $views .' </span>';
    }

}

function checkAuth($id){
  if(Auth::id() == 1){
    return true;
  }else{
    $data = AdminMenuUserModel::where(['user_id'=>Auth::id(),'adminmenu_id'=>$id])->first();
    if($data){
      return true;
    }
  }
  return false;
}

function galleryname($id){
  $data = ImageGalleryCategoryModel::where('id',$id)->first();
  return $data->category;
}
