@extends('admin.master')
@section('title','Banner')
@section('breadcrumb')
     <a href="admin/banner" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')

<form class="form-horizontal" role="form" action="{{ url('admin/banner') }}" method="post" enctype="multipart/form-data">
           {{ csrf_field() }}         
<div class="col-md-12">
            <!-- Input Fields -->
            <div class="panel">
              <div class="panel-heading">
                <span class="panel-title">New Banner</span>
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

                  <!--   <div class="form-group">
                    <label class="col-lg-3 control-label" for="videolink">Video</label>
                    <div class="col-lg-6">
                      <div class="bs-component">
                        <input type="text" class="form-control" name="video" placeholder="" /> <br />                       
                      </div>
                    </div>
                  </div>  -->
               
                  <div class="form-group">
                    <label class="col-lg-3 control-label" for="textArea2">Content</label>
                    <div class="col-lg-6">
                      <div class="bs-component">
                        <textarea class="form-control" id="textArea2" name="banner_content" rows="3"></textarea>
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
                          <i><small> Example: https://www.google.com </small></i>
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