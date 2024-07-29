@extends('admin.master')
@section('breadcrumb')
<a href="{{ url('doc/multipledocument/'.Request::segment(3) ) }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')
<div class="alert" id="message" style="display: none"></div>
<form class="form-horizontal" id="upload_image1" role="form" action="{{ route('multipledocument.store') }}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}               
	<div class="col-md-8">
		<!-- Input Fields -->
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Add Document</span>
			</div>
			<div class="panel-body">  
				<input type="hidden" name="post_id" value="{{ $post_id }}">
				<div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label"> Title </label>
					<div class="col-lg-8">
						<div class="bs-component">
							<input type="text" name="title" id="title" class="form-controller" /> 	
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label"> Ordering </label>
					<div class="col-lg-8">
						<div class="bs-component">
							<input type="number" name="ordering" id="ordering" value="{{$ordering}}" class="form-controller" /> 	
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label"> Document </label>
					<div class="col-lg-8">
						<div class="bs-component">
							<input type="file" name="document" id="document" class="form-controller" /> 	
						</div>
					</div>
				</div>  

				<div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label">  </label>
					<div class="col-lg-8">
						<div class="bs-component">
							<input type="submit" name="submit" value="Submit">      
						</div>
					</div>
				</div>  
			</div>
		</div> 

	</div>

</form>
@endsection

@section('libraries')
<script type="text/javascript">
	$('document').ready(function(){
		
});
</script>
@endsection
