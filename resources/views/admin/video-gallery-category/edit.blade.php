@extends('admin.master')
@section('breadcrumb')
     <a href="{{ route('videocategory.index') }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')
<form class="form-horizontal" role="form" action="{{route('videocategory.update', $data->id)}}" method="post" enctype="multipart/form-data">
           {{ csrf_field() }}    
           <input type="hidden" name="_method" value="PUT" />        
<div class="col-md-10">
            <!-- Input Fields -->
            <div class="panel">
              <div class="panel-heading">
                <span class="panel-title">Edit Video Category </span>
              </div>
              <div class="panel-body"> 
                           
                  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label"> Category </label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        <input type="text" id="inputStandard" name="category" class="form-control" placeholder="" value="{{$data->category}}" />
                      </div>
                    </div>
                  </div> 

                   <div class="form-group">
                    <label class="col-lg-3 control-label" for="textArea3"> Video Link </label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        <textarea class="form-control" id="textArea3" name="video" rows="3" autocomplete="off">{{$data->video}}</textarea>
                      </div>
                    </div>
                  </div> 
                  @if($data->video)
                  <div class="form-group">
                    <label class="col-lg-3 control-label" for="textArea3">  </label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        {!! $data->video !!}
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

          </form>
@endsection
