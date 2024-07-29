@extends('admin.master')
@section('breadcrumb')
<a href="{{ route('admin.multiplevideo.index', Request::segment(2) ) }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')
<div class="alert" id="message" style="display: none"></div>
<form class="form-horizontal" id="upload_image1" role="form" action="{{ route('admin.multiplevideo.store',Request::segment(2) ) }}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}               
	<div class="col-md-8">
		<!-- Input Fields -->
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Add Video</span>
			</div>
			<div class="panel-body">  
				<input type="hidden" name="post_id" value="{{ Request::segment(2) }}">

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
							<input type="number" name="ordering" id="ordering" class="form-controller" /> 		
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label"> Video </label>
					<div class="col-lg-8">
						<div class="bs-component">
						<textarea name="video" id="video" cols="50" rows="5" class="form-controller"></textarea> 
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

		<hr>
        

	</div>

	<div class="col-md-4">
		<div class="admin-form">
			<div class="sid_bvijay mb10">  


			</div>
		</div>
	</div>
</form>
@endsection

@section('libraries')
<script type="text/javascript">
	$('document').ready(function(){

		$('#upload_image').on('submit',function(event){
			event.preventDefault();
			$.ajax({
				url: "{{-- route('multiplephoto.store') --}}",
				method: "POST",
				data:new FormData(this),
				dataType:'JSON',
				contentType:false,
				cache:false,
				processData:false,
				success:function(data){
					$('#message').css('display','block');
					$('#message').html(data.message);
					$('#message').addClass(data.class_name);
					location.reload();
				},
				error:function(data){					
					alert('Error!!');
				}
			});
		});

// Delete Product Image
  $('.delete_image').on('click',function(e){
    e.preventDefault();
    var csrf = $('meta[name="csrf-token"]').attr('content');
    var str = $(this).attr('href');
    var id = str.slice(1);
    $.ajax({
      type:'delete',
      url:"{{-- url('/multiplephoto') . '/' --}}" + id,
      data:{_token:csrf},    
      success:function(data){   
       $('#message').css('display','block');
       $('#message').html(data.message);
       $('#message').addClass(data.class_name);
       $('div .id'+id ).remove();
      },
      error:function(data){       
       alert('Error occurred!');
     }
   });
  });


});
</script>
@endsection
