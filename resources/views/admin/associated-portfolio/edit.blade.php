@extends('admin.master')
@section('title','Post Category')
@section('breadcrumb')

@endsection
@section('content')
<form class="form-horizontal" role="form" action="{{url('admin/associates/'.Request::segment(3).'/'.Request::segment(4))}}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}      
   <input type="hidden" name="_method" value="PUT" />        
  <div class="col-md-8">
    <!-- Input Fields -->
    <div class="panel">
      <div class="panel-heading">
        <span class="panel-title">Edit Associated Post</span>
      </div>
      <div class="panel-body">
  <input type="hidden" name="portfolio_id" value="{{Request::segment(4)}}" />
     <div class="form-group">
        <label for="title" class="col-lg-3 control-label">Title</label>
        <div class="col-lg-8">
          <div class="bs-component">
            <input type="text" id="title" name="title" class="form-control" value="{{$data->title}}" />
          </div>
        </div>
      </div>   

    <div class="form-group">
     <label for="inputStandard" class="col-lg-3 control-label">Brief</label>
     <div class="col-lg-8">
      <div class="bs-component">                       
        <div class="bs-component">
          <textarea class="form-control my-editor" id="" name="brief" rows="3" autocomplete="off">{{$data->brief}}</textarea>
        </div>
      </div>
    </div>
  </div>   

  <div class="form-group">
        <label for="title" class="col-lg-3 control-label">Ordering</label>
        <div class="col-lg-8">
          <div class="bs-component">
            <input type="text" id="ordering" name="ordering" class="form-control" value="{{$data->ordering}}" />
          </div>
        </div>
  </div>

    <div class="form-group">
     <label for="inputStandard" class="col-lg-3 control-label">Thumbnail</label>
     <div class="col-lg-8">
      <div class="bs-component">                       
        <div class="bs-component">
          <div id="xedit-demo">
            @if($data->thumbnail)
              <span class="id{{$data->id}}">
              <a href="#{{$data->id}}" class="imagedelete"></a>
              <img src="{{ asset(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail) }}" width="150" />
              </span>
              <hr> 
              @endif 
         <input type="file" name="thumbnail" />
       </div>
        </div>
      </div>
    </div>
  </div> 

  <div class="form-group">
    <label class="col-lg-3 control-label" for=""> </label>
    <div class="col-lg-8">
      <div class="bs-component">
       <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
     </div>
   </div>
 </div> 


</div>
</div>          
</div>

<div class="col-md-4"> </div>
</form>
@endsection
@section('scripts')
@endsection