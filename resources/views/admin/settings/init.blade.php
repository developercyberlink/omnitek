@extends('admin.master')
@section('title','Setting')
@section('breadcrumb')     
@endsection
@section('content')

<form class="form-horizontal" role="form" action="{{ url('init',1) }}" method="post" enctype="multipart/form-data">
           {{ csrf_field() }}    
           <input type="hidden" name="_method" value="PUT" />        
<div class="col-md-12">
            <!-- Input Fields -->
            <div class="panel">
              <div class="panel-heading">
                <span class="panel-title">Init Setting</span>
              </div>
              <div class="panel-body"> 
             
                  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label"> Code </label>
                    <div class="col-lg-6">
                      <div class="bs-component">
                        <input type="text" id="inputStandard" name="code" class="form-control" placeholder="" value="{{$data->code}}" />
                      </div>
                    </div>
                    <i> ( Valid code should be '123' )</i>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label"> Status </label>
                    <div class="col-lg-6">
                      <div class="bs-component">
                        <input type="text" id="inputStandard" name="status" class="form-control" placeholder="" value="{{$data->status}}" />
                      </div>
                    </div>
                   <i> ( Valid status should be '1' or '0' )</i>
                  </div>
                                     
                  <div class="form-group">
                    <label class="col-lg-3 control-label" for=""></label>
                    <div class="col-lg-3">
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