@extends('admin.master')
@section('title','Post Type')
@section('breadcrumb')
     <a href="{{ route('circulartype.index') }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')
<form class="form-horizontal" role="form" action="{{route('circulartype.store')}}" method="post" enctype="multipart/form-data">
           {{ csrf_field() }}            
<div class="col-md-8">
            <!-- Input Fields -->
            <div class="panel">
              <div class="panel-heading">
                <span class="panel-title">New Circular Type</span>
              </div>
              <div class="panel-body"> 
                           
                  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Circular Type</label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        <input type="text" id="circular_type" name="circular_type" class="form-control" placeholder="" />
                      </div>
                    </div>
                  </div>  

                  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label"> Uri</label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        <input type="text" id="uri" name="uri" class="form-control" placeholder="" />
                      </div>
                    </div>
                  </div> 
                  
                   <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label"> Ordering </label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        <input type="text" id="ordering" name="ordering" class="form-control" placeholder="" />
                      </div>
                    </div>
                  </div>  
              
                   <div class="form-group">
                    <label class="col-lg-3 control-label" for="textArea3"></label>
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
@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
  // var post_type;
  // $('#post_type').on('keyup', function(){
  //   post_type=post_type.replace(/[^a-zA-Z0-9 ]+/g,"");
  //   post_type=post_type.replace(/\s+/g, "-");
  //     $('#uri').val(post_type);
  // });
});  
</script>
@endsection


