@extends('admin.master')
@section('title', Request::segment(2))
@section('breadcrumb')

<a href="{{ route('our-trades.index') }}" class="btn btn-primary btn-sm">List</a>
<a href="{{ route('our-trades.create') }}" class="btn btn-primary btn-sm">Create</a>

@endsection
@section('content')
<form class="form-horizontal" role="form" action="{{ route('our-trades.update',$data->id) }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}  
  <input type="hidden" name="_method" value="PUT" />  
                          
  <div class="col-md-9">
    <!-- Input Fields -->
    <div class="panel">
      <div class="panel-heading">
        <span class="panel-title">Edit Trade</span>
      </div>
      <div class="panel-body">                  
        <div class="form-group">
          <label for="inputStandard" class="col-lg-2 control-label">Title</label>
          <div class="col-lg-9">
            <div class="bs-component">
              <input type="text" id="title" name="title" class="form-control" value="{{$data->title}}" />
              <input type="hidden" id="uri" name="uri" class="form-control" value="{{$data->uri}}" />
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="inputStandard" class="col-lg-2 control-label">Sub Title</label>
          <div class="col-lg-9">
            <div class="bs-component">
              <input type="text" id="" name="sub_title" class="form-control" value="{{$data->sub_title}}"  />
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="inputSelect" class="col-lg-2 control-label"> Category </label>
          <div class="col-lg-9">
            <div class="bs-component">

              <select name="category_id" class="form-control">
                <option value="0"> Select Category </option>
                @if($category)
                @foreach($category as $row)
                <option value="{{$row->id}}" {{ ($row->id == $data->category_id )?'selected':'' }}> {{$row->category}}</option>
                @endforeach  
                @endif 
              </select>
              <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
            </div>
          </div>      

            <div class="form-group">
              <label class="col-lg-2 control-label" for="textArea3"> Brief </label>
              <div class="col-lg-9">
                <div class="bs-component">
                  <textarea class="form-control" id="" name="brief" rows="3"> {{$data->brief}}</textarea>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-2 control-label" >UID</label>
              <div class="col-lg-10">
                <div class="bs-component">
                   <input type="text" id="" name="content" class="form-control" placeholder="" value="{{$data->content}}" />     
               
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="inputStandard" class="col-lg-2 control-label">Duration of course</label>
              <div class="col-lg-9">
                <div class="bs-component">
                  <input type="text" id="" name="client_name" class="form-control" placeholder="" value="{{$data->client_name}}" />
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="inputStandard" class="col-lg-2 control-label">Total training hours:</label>
              <div class="col-lg-9">
                <div class="bs-component">
                  <input type="text" id="" name="country" class="form-control" placeholder="" value="{{$data->country}}" />
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="inputStandard" class="col-lg-2 control-label"> Minimum qualification of the participant: </label>
              <div class="col-lg-9">
                <div class="bs-component">
                  <input type="text" id="" name="service" class="form-control" placeholder="" value="{{$data->service}}" />
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="inputStandard" class="col-lg-2 control-label">	Target group</label>
              <div class="col-lg-9">
                <div class="bs-component">
                  <input type="text" id="" name="year" class="form-control" placeholder="" value="{{$data->year}}" />
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="inputStandard" class="col-lg-2 control-label">Medium of instruction</label>
              <div class="col-lg-9">
                <div class="bs-component">
                  <input type="text" id="" name="meta_keyword" class="form-control" value="{{$data->meta_keyword}}" />
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-2 control-label" for="textArea3"> Method</label>
              <div class="col-lg-9">
                <div class="bs-component">
                   <input type="text" id="" name="meta_description" class="form-control" value="{{$data->meta_description}}" />
                
                </div>
              </div>
            </div>              

            <div class="form-group">
              <label for="inputStandard" class="col-lg-2 control-label"> Group structure</label>
              <div class="col-lg-9">
                <div class="bs-component">
                  <input type="text" id="" name="external_link" class="form-control" value="{{$data->external_link}}" />
                </div>
              </div>
            </div>

          </div>
        </div>          
      </div>

      <div class="col-md-3">
        <div class="admin-form">
          <div class="sid_ mb10">                   
            <div class="hd_show_con">
              <div class="publice_edi">
                Status: <a href="avoid:javascript;" data-toggle="collapse" data-target="#publish_1">Active</a>
              </div>                    
            </div>
            <footer>
              <div id="publishing-action">
                <input type="submit" class="btn btn-primary btn-sm" value="Update" />
              </div>
              <div class="clearfix"></div>
            </footer>
            <div class="clearfix"></div>
          </div> 

          <div class="sid_ mb10">
          <label class="field text">
            <input type="number" id="" name="ordering" class="form-control" placeholder="Ordering" value="{{$data->ordering}}" />   
          </label>
        </div>
<!-- // -->
        <div class="sid_ mb10">
          <h4> Icon </h4>
            <div class="hd_show_con">
            <div id="xedit-demo"> 
              @if($data->icon)
              <span class="iconid{{$data->id}}">
              <a href="#{{$data->id}}" class="delete_icon">X</a>
              <img src="{{ asset(env('PUBLIC_PATH').'uploads/medium/' . $data->icon) }}" width="150" />
              <hr>
              </span>               
              @endif                       
             <input type="file" name="icon" />
            </div>
          </div>
        </div>

        <div class="sid_ mb10">
          <h4> Thumbnail </h4>
            <div class="hd_show_con">
            <div id="xedit-demo"> 
              @if($data->thumbnail)
              <span class="thumbnailid{{$data->id}}">
              <a href="#{{$data->id}}" class="delete_thumbnail">X</a>
              <img src="{{ asset(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail) }}" width="150" />
              <hr>
              </span>              
              @endif                       
             <input type="file" name="thumbnail" />
            </div>
          </div>
        </div>

        <div class="sid_ mb10">        
          <h4> Page Thumbnail </h4>
            <div class="hd_show_con">
            <div id="xedit-demo"> 
              @if($data->page_thumbnail)
              <span class="page_thumbnailid{{$data->id}}">
              <a href="#{{$data->id}}" class="delete_pagethumbnail">X</a>
              <img src="{{ asset(env('PUBLIC_PATH').'uploads/medium/' . $data->page_thumbnail) }}" width="150" />
              <hr>
              </span>
              @endif                       
             <input type="file" name="page_thumbnail" />
            </div>
          </div>
        </div>

        <div class="sid_ mb10">
          <h4> Banner </h4>
            <div class="hd_show_con">
            <div id="xedit-demo"> 
              @if($data->banner)
              <span class="bannerid{{$data->id}}">
              <a href="#{{$data->id}}" class="delete_banner">X</a>
              <img src="{{ asset(env('PUBLIC_PATH').'uploads/medium/' . $data->banner) }}" width="150" />
              <hr>
              </span>
              @endif                       
             <input type="file" name="banner" />
            </div>
          </div>
        </div>

<!-- // -->
      </div>        
    </div>
  </form>
  @endsection

  @section('libraries')
  <script type="text/javascript">
  $('.delete_icon').on('click',function(e){
    e.preventDefault();
    if(!confirm('Are you sure to delete?')) return false;
    var csrf = $('meta[name="csrf-token"]').attr('content');
    var str = $(this).attr('href');
    var id = str.slice(1);
    $.ajax({
      type:'delete',
      url:"{{url('delete_picon') . '/'}}" + id,
      data:{_token:csrf},    
      success:function(data){ 
        $('span.iconid' + id ).remove();
      },
      error:function(data){  
      alert(data + 'Error!');     
     }
   });
  });
  /****************/
  $('.delete_thumbnail').on('click',function(e){
    e.preventDefault();
    if(!confirm('Are you sure to delete?')) return false;
    var csrf = $('meta[name="csrf-token"]').attr('content');
    var str = $(this).attr('href');
    var id = str.slice(1);
    $.ajax({
      type:'delete',
      url:"{{url('delete_pthumbnail') . '/'}}" + id,
      data:{_token:csrf},    
      success:function(data){ 
        $('span.thumbnailid' + id ).remove();
      },
      error:function(data){  
      alert(data + 'Error!');     
     }
   });
  });
  /**************/
  $('.delete_pagethumbnail').on('click',function(e){
    e.preventDefault();
    if(!confirm('Are you sure to delete?')) return false;
    var csrf = $('meta[name="csrf-token"]').attr('content');
    var str = $(this).attr('href');
    var id = str.slice(1);
    $.ajax({
      type:'delete',
      url:"{{url('delete_portfolio_thumb') . '/'}}" + id,
      data:{_token:csrf},    
      success:function(data){ 
        $('span.page_thumbnailid' + id ).remove();
      },
      error:function(data){  
      alert(data + 'Error!');     
     }
   });
  });
  /****************/
  $('.delete_banner').on('click',function(e){
    e.preventDefault();
    if(!confirm('Are you sure to delete?')) return false;
    var csrf = $('meta[name="csrf-token"]').attr('content');
    var str = $(this).attr('href');
    var id = str.slice(1);
    $.ajax({
      type:'delete',
      url:"{{url('delete_pbanner') . '/'}}" + id,
      data:{_token:csrf},    
      success:function(data){ 
        $('span.bannerid' + id ).remove();
      },
      error:function(data){  
      alert(data + 'Error!');     
     }
   });
  });
  /*****************/
  $(document).ready(function(){
      $('#title').on('keyup',function(){
        var title;
        title = $('#title').val();
        title=title.replace(/[^a-zA-Z0-9 ]+/g,"");
        title=title.replace(/\s+/g, "-");
        $('#uri').val(title);
      });
    });
  </script>
  @endsection