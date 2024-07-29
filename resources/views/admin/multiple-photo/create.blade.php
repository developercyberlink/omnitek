@extends('admin.master')
@section('breadcrumb')
<a href="{{ route('admin.multiplephoto.index',Request::segment(2)) }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')
<div class="alert" id="message" style="display: none"></div>
<form class="form-horizontal" id="upload_image1" role="form" action="{{ route('admin.multiplephoto.store',Request::segment(2)) }}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}               
	<div class="col-md-8">
		<!-- Input Fields -->
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Add Image</span>
			</div>
			<div class="panel-body">  
				<input type="hidden" name="post_id" value="{{Request::segment(2)}}">
				<div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label"> Image </label>
					<div class="col-lg-8">
						<div class="bs-component">
							<input type="file" name="file_image" id="file_image" class="form-controller" /> 	
						</div>
						( Width: 1000px, Height: 500px) <br/>
						Please upload same size all time.
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
		<?php /* ?>
        <?php $i =0; ?>
		@if($data->count() > 0)               
		@foreach($data as $row)
		<div class="col-lg-2 id{{$row->id}}">
			<a href="#{{$row->id}}" class="delete_image">X</a>
			<img src="{{ asset('public/uploads/medium/' . $row->file_name) }}" width="100" height="100" /> 
		</div>
		<?php $i++; 
		
		if($i%5 == 0){
		    echo '<div class="clearfix"></div>';
		}
		?>
		@endforeach
		@endif 
<?php */ ?>
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
      url:"{{ url('admin/multiplephoto') . '/' }}" + id,
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
