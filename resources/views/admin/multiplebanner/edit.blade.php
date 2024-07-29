@extends('admin.master')
@section('title','Banner')
@section('breadcrumb')
     <a href="{{ route('admin.multiplebanner.index',Request::segment(2)) }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')

<form class="form-horizontal" role="form" action="{{ route('admin.multiplebanner.update', ['banner_id'=>Request::segment(2),'id'=>$data->id] ) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}   
<input type="hidden" name="_method" value="PUT" />          
<div class="col-md-12">
            <!-- Input Fields -->
            <div class="panel">
              <div class="panel-heading">
                <span class="panel-title">Edit Banner / Popup</span>
              </div>
              <div class="panel-body"> 
             
                  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Title</label>
                    <div class="col-lg-6">
                      <div class="bs-component">
                        <input type="text" id="" name="title" class="form-control" placeholder="" value="{{$data->title}}" />
                      </div>
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Caption</label>
                    <div class="col-lg-6">
                      <div class="bs-component">
                        <input type="text" id="" name="caption" class="form-control" placeholder="" value="{{$data->caption}}" />
                      </div>
                    </div>
                  </div>
               
                  <div class="form-group">
                    <label class="col-lg-3 control-label" for="textArea2">Size (for popup)</label>
                    <div class="col-lg-6">
                      <div class="bs-component">
                       <label class="col-lg-2 control-label">
                          <select id="template" name="content">
                          @if($data->content != NULL)
                            <option value="{{$data->content}}" selected>{{$data->content}}</option>
                            @else
                              <option value="" selected>Choose Size</option> 
                             @endif 
                                       
                            <option value="sm"> small (sm)</option>
                             <option value="md"> medium (md)</option>
                              <option value="lg"> large (lg)</option> 
                             

                      </select>  <i class="arrow"></i>              
                        </label>
                      </div>
                    </div>
                  </div>                 
                  
               <div class="form-group">
                    <label class="col-lg-3 control-label" for="banner">Banner</label>
                    <div class="col-lg-6">
                      <div class="bs-component">
                        <input type="file" class="form-control" name="picture"/>
                      </div> <br />
                       ( Width: 1900px, Height:560px all time fix size )
                    </div>
                    
                  </div>

                  @if($data->picture != '' OR $data->picture != null)
                  <div class="form-group">
                    <label class="col-lg-3 control-label" for="banner"></label>
                    <div class="col-lg-6">
                      <div class="bs-component">
                        <img src="{{url(env('PUBLIC_PATH').'uploads/banners/' . $data->picture )}}" width="70%" />
                      </div>
                    </div>
                  </div>                    
                  @endif

                   <div class="form-group">
                    <label class="col-lg-3 control-label" for="link">Link Title</label>
                    <div class="col-lg-6">
                      <div class="bs-component">
                        <input type="text" class="form-control" name="link_title" value="{{$data->link_title}}" placeholder="Link Title" /> <br />                       
                      </div>
                    </div>
                  </div> 

                 <div class="form-group">
                    <label class="col-lg-3 control-label" for="link">Link</label>
                    <div class="col-lg-6">
                      <div class="bs-component">
                        <input type="text" class="form-control" name="link" value="{{$data->link}}" placeholder="http://www.google.com" /> <br />
                       
                      </div>
                    </div>
                  </div> 
                    <div class="form-group">
                    <label class="col-lg-3 control-label" for="">Status</label>
                    <div class="col-lg-6">
                      <div class="bs-component">                                   
                    <input type="checkbox" name="status" value="{{ $data->status }}" {{ ($data->status == 1)?'checked':'' }} /> 
                   Enable / Disable   <br>                   
                  </div>
                </div>
              </div>
                 
                  <div class="form-group">
                    <label class="col-lg-3 control-label" for=""></label>
                    <div class="col-lg-6">
                      <div class="bs-component">
                        <input type="submit" class="form-control btn btn-primary" name="submit" value="Submit" />
                      </div>
                    </div>
                  </div> 
                
              </div>
            </div>          
          </div>

          
          </form>
          
          @endsection