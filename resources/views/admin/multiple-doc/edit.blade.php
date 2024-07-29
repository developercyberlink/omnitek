@extends('admin.master')
@section('breadcrumb')
<a href="{{ url('doc/multipledocument/' . Request::segment(3) ) }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')
<div class="alert" id="message" style="display: none"></div>
<form class="form-horizontal" id="upload_image1" role="form" action="{{ url('doc/multipledocument',$data->id) }}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}   
	<input type="hidden" name="_method" value="PUT" />           
	<div class="col-md-8">
		<!-- Input Fields -->
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Edit Video</span>
			</div>
			<div class="panel-body">  
				<input type="hidden" name="post_id" value="{{ Request::segment(3) }}">

				<div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label"> Title </label>
					<div class="col-lg-8">
						<div class="bs-component">
							<input type="text" name="title" id="title" value="{{ ($data->title)?$data->title:"" }}" class="form-controller" /> 		
						</div>
					</div>
				</div>

				
				<div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label"> Ordering </label>
					<div class="col-lg-8">
						<input type="text" name="ordering" value="{{ ($data->ordering)?$data->ordering:'' }}" class="form-controller" /> 		
					</div>
				</div>
				

				<div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label"> Document </label>
					<div class="col-lg-8">
						<div class="bs-component">
							<input type="file" name="document" class="form-controller" /> 
						</div>
					</div>
				</div> 

				@if($data->document)
				<div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label"> </label>
					<div class="col-lg-8">
						<div class="bs-component">
							 <span class="id{{$data->id}}">
             					 <a href="#{{$data->id}}" class="delete_doc">X</a>
							{{ ($data->title == '')?$data->document:$data->title }} 
						</span>
						</div>
					</div>
				</div> 
				@endif 

				<div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label">  </label>
					<div class="col-lg-8">
						<div class="bs-component">
							<input type="submit" name="submit" value="Submit" />      
						</div>
					</div>
				</div> 
			</div>


		</div>
	</div> 

	<div class="col-md-12">
		<div class="admin-form">
			<div class="">  

				

			</div>
		</div>
	</div>
</form>
@endsection

@section('libraries')
<script type="text/javascript">
	$('document').ready(function(){
	// Delete Doc
    $('.delete_doc').on('click',function(e){
    e.preventDefault();
    if(!confirm('Are you sure to delete?')) return false;
    var csrf = $('meta[name="csrf-token"]').attr('content');
    var str = $(this).attr('href');
    var id = str.slice(1);
    $.ajax({
      type:'DELETE',
      url:"{{url('doc/multipledocument') . '/'}}" + id,
      data:{_token:csrf},    
      success:function(data){ 
        $('span.id' + id ).remove();
      },
      error:function(data){  
      alert(data + 'Error!');     
     }
   });
  });


});
</script>
@endsection
