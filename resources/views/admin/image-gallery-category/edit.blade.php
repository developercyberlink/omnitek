@extends('admin.master')
@section('breadcrumb')
     <a href="/admin/{{ Request::segment(2) }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')
<form class="form-horizontal" role="form" action="{{url('/admin/imagecategory', $data->id)}}" method="post" enctype="multipart/form-data">
           {{ csrf_field() }}  
<input type="hidden" name="_method" value="PUT" />  
<div class="col-md-8">
            <!-- Input Fields -->
            <div class="panel">
              <div class="panel-heading">
                <span class="panel-title">New Image Category </span>
              </div>
              <div class="panel-body"> 
                           
                  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Category </label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        <input type="text" id="inputStandard" name="category" class="form-control" placeholder="" value="{{$data->category}}"  />
                      </div>
                    </div>
                  </div> 

                   <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Picture </label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        <input type="file" id="inputStandard" name="picture" class="form-control" placeholder="" />
                      </div>
                    </div>
                  </div>  

                  @if($data->picture != '' )
                  <div class="form-group">
                    <label class="col-lg-3 control-label" for="banner"></label>
                    <div class="col-lg-6">
                      <div class="bs-component">
                        <img src="{{url(env('PUBLIC_PATH').'/uploads/galleries/' . $data->picture )}}" width="400" height="200" />
                      </div>
                    </div>
                  </div>                    
                  @endif    

                  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label"> Caption </label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        <input type="text" id="inputStandard" name="caption" class="form-control" placeholder="" value="{{$data->caption}}" />
                      </div>
                    </div>
                  </div>         
              
                   <div class="form-group">
                    <label class="col-lg-3 control-label" for="textArea3"> </label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                       <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
                      </div>
                    </div>
                  </div> 

              </div>
            </div>          
          </div>

          </form>

@endsection