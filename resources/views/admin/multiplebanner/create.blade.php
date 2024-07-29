@extends('admin.master')
@section('title','Banner')
@section('breadcrumb')
     <a href="{{ route('admin.multiplebanner.index',Request::segment(2))}}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')
<form class="form-horizontal" role="form" action="{{  route('admin.multiplebanner.store',Request::segment(2))}}" method="post" enctype="multipart/form-data">
           {{ csrf_field() }}    
           <input type="hidden" name="parentId" value="{{Request::segment(2)}}" />     
<div class="col-md-12">
            <!-- Input Fields -->
            <div class="panel">
              <div class="panel-heading">
                <span class="panel-title"> Add Banner / Popup </span>
              </div>
              <div class="panel-body"> 
             
                  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Title</label>
                    <div class="col-lg-6">
                      <div class="bs-component">
                        <input type="text" id="inputStandard" name="title" class="form-control" placeholder="" />
                      </div>
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Caption</label>
                    <div class="col-lg-6">
                      <div class="bs-component">
                        <input type="text" id="inputStandard" name="caption" class="form-control" placeholder="" />
                      </div>
                    </div>
                  </div>
               
                  <div class="form-group">
                    <label class="col-lg-3 control-label" for="textArea2">Size (for popup)</label>
                    <div class="col-lg-6">
                      <div class="bs-component">
                       <label class="col-lg-2 control-label">
                          <select id="template" name="content"> 
                           <option value="" selected>Choose Size</option>              
                            <option value="sm"> small (sm)</option>
                             <option value="md"> medium (md)</option>
                              <option value="lg"> large (lg)</option> 
                             

                      </select>  <i class="arrow"></i>              
                        </label>
                      </div>
                    </div>
                  </div>                 
                  
               <div class="form-group">
                    <label class="col-lg-3 control-label" for="banner">Picture</label>
                    <div class="col-lg-6">
                      <div class="bs-component">
                        <input type="file" class="form-control" name="picture"/>
                      </div>
                      ( Width: 1500px, Height:500px all time fix size )
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="col-lg-3 control-label" for="link">Link Title</label>
                    <div class="col-lg-6">
                      <div class="bs-component">
                        <input type="text" class="form-control" name="link_title" placeholder="Link Title" /> <br />                       
                      </div>
                    </div>
                  </div> 

                 <div class="form-group">
                    <label class="col-lg-3 control-label" for="link">Link</label>
                    <div class="col-lg-6">
                      <div class="bs-component">
                        <input type="text" class="form-control" name="link" placeholder="http://www.google.com" /> <br />                       
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