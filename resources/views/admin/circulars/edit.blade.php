@extends('admin.master')
@section('title','Post')
@section('breadcrumb')
<a href="{{ url('admin/circulartype', Request::segment(3)) }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')
<form class="form-horizontal" role="form" action="{{ url('admin/circulartype/'. Request::segment(3)  .'', $data->id) }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}  
  <input type="hidden" name="_method" value="PUT" />  
  <input type="hidden" name="circular_type" value="{{ Request::segment(1) }}" />   
  
  <div class="col-md-9">
    <!-- Input Fields -->
    <div class="panel">
      <div class="panel-heading">
        <span class="panel-title">Edit Post</span>
      </div>
      <div class="panel-body"> 
        <input type="hidden" name="circular_date" value="<?=date('Y-m-d h:i:s')?>" />              
        <div class="form-group">
          <label for="inputStandard" class="col-lg-3 control-label">Title</label>
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" id="inputStandard" name="circular_title" class="form-control" value="{{$data->circular_title}}" />
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="inputStandard" class="col-lg-3 control-label">Sub Title</label>
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" id="inputStandard" name="sub_title" class="form-control" value="{{$data->sub_title}}"  />
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="inputStandard" class="col-lg-3 control-label">Uri</label>
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" id="inputStandard" name="uri" class="form-control" value="{{$data->uri}}" />
            </div>
          </div>
        </div>
       
            <div class="form-group">
              <label class="col-lg-3 control-label" for="textArea3"> Brief </label>
              <div class="col-lg-8">
                <div class="bs-component">
                  <textarea class="form-control" id="textArea3" name="circular_excerpt" rows="3"> {{$data->circular_excerpt}}</textarea>
                </div>
              </div>
            </div>

          </div>
        </div>  
        
        <div class="panel">
                    <div class="panel-heading">Content</div>
                    <div class="panel-body">
                            <div class="form-group">
                                  <textarea class="form-control my-editor" id="" name="circular_content" rows="3"> {{$data->circular_content}}</textarea>
                            </div>
                    </div>
                </div>
        
      </div>
      <div class="col-md-3">
        <div class="admin-form">
          <div class="sid_bvijay mb10">                   
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
        
           <div class="section mb15">
               <label class="field select">
                        <select name="department[]" multiple>
                        <option disabled selected>Choose Department </option>
                        @if($department->count() > 0)
                        @foreach($department as $row)
                        @empty($data->department)
                        <option value="{{$row->id}}"> {{$row->department}} </option>
                        @else
                        <option value="{{$row->id}}" {{ (in_array($row->id,unserialize($data->department)))?'selected':''}}> {{$row->department}} </option>
                        @endempty
                        
                        @endforeach
                        @endif
                        </select>
                        <i class="arrow"></i>
                      </label>
            </div> 
            
            <!-- <div class="sid_bvijay mb30" ng-show="showBox">
                    <h4> Member List</h4>
                    <div class="hd_show_con">
                        <div class="tab-content mb15">
                            <div id="tab18_1" class="tab-pane active">
                                <ul class="ctgor">
                                    <li>
                                        <label class="option"> <input type="checkbox" name="user[]"> <span class="checkbox"></span> User Name </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
               </div> -->
               
        <div class="sid_bvijay mb10">
          <label class="field text">
            <input type="number" id="inputStandard" name="ordering" class="form-control" placeholder="Circular Order" value="{{$data->ordering}}" />   
          </label>
        </div>

         <div class="sid_bvijay mb10">
          <h4> Thumbnail </h4>
            <div class="hd_show_con">
            <div id="xedit-demo">
              @if($data->circular_thumbnail)
               <span class="id{{$data->id}}">
                   <a href="#{{$data->id}}" class="imagedelete">X</a>
              <img src="{{ asset('public/uploads/large/' . $data->circular_thumbnail) }}" width="50%" />
              </span>
              <hr> 
              @endif                       
             <input type="file" name="circular_thumbnail" />
            </div>
          </div>
        </div>
      </div>         

    </div>
  </form>
  @endsection
  
  
 @section('libraries')
  <script type="text/javascript">
   // Delete Thumb
   (function ( $ ) {
    $('.imagedelete').on('click',function(e){
    e.preventDefault();
    if(!confirm('Are you sure to delete?')) return false;
    var csrf = $('meta[name="csrf-token"]').attr('content');
    var str = $(this).attr('href');
    var id = str.slice(1);
    $.ajax({
      type:'delete',
      url:"{{url('delete_circular_thumb') . '/'}}" + id,
      data:{_token:csrf},    
      success:function(data){ 
        $('span.id' + id ).remove();
      },
      error:function(data){  
      alert(data + 'Error!');     
     }
   });
  });
   }( jQuery ));
  </script>
  @endsection
  
  