@extends('admin.master')
@section('title','Circular Type')
@section('breadcrumb')
<a href="{{ route('circulartype.index') }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')
<form class="form-horizontal" role="form" action="{{ route('circulartype.update', $data->id) }}" method="post" enctype="multipart/form-data">
	 {{ csrf_field() }}     
	<input type="hidden" name="_method" value="PUT" />          
	<div class="col-md-8">
		<!-- Input Fields -->
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Edit Circular Type</span>
			</div>
			<div class="panel-body"> 				
				<div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label"> Circular Type </label>
					<div class="col-lg-8">
						<div class="bs-component">
							<input type="text" id="inputStandard" name="circular_type" class="form-control" placeholder="" value="{{$data->circular_type}}" />
						</div>
					</div>
				</div>         
				 <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label"> Uri</label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        <input type="text" id="inputStandard" name="uri" class="form-control" placeholder="" value="{{$data->uri}}" />
                      </div>
                    </div>
                  </div> 
                  
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label"> Ordering </label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        <input type="text" id="ordering" name="ordering" class="form-control" placeholder="" value="{{$data->ordering}}" />
                      </div>
                    </div>
                  </div>  

				<div class="form-group">
					<label class="col-lg-3 control-label" for="textArea3">  </label>
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