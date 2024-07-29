@extends('admin.master')
@section('breadcrumb')
<a href="{{ url('tender') }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')
<div class="alert" id="message" style="display: none"></div>
<form class="form-horizontal" id="upload_file1" action="{{ route('doc.store') }}" role="form" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}               
	<div class="col-md-8">
		<!-- Input Fields -->
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Add File</span>
			</div>
			<div class="panel-body">  
				<input type="hidden" name="tender_id" value="{{ $id }}">

				<div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label"> Title </label>
					<div class="col-lg-8">
						<div class="bs-component">
							<input type="text" name="title" class="form-controller" />
						</div>
					</div>
				</div> 
				<div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label"> Document (PDF) </label>
					<div class="col-lg-8">
						<div class="bs-component">
							<input type="file" name="file_name" id="file_name" class="form-controller" />
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
        <?php $i =0; ?>
		@if($data->count() > 0)               
		@foreach($data as $row)
		<div class="col-lg-12 id{{$row->id}}">
			
		<p>{{ $row->file_name }} <a href="#{{$row->id}}" class="delete_file">X</a></p> 
		</div>
		<?php $i++; 
		
		if($i%5 == 0){
		    echo '<div class="clearfix"></div>';
		}
		?>
		@endforeach
		@endif

	</div>

</form>
@endsection

@section('libraries')
<script type="text/javascript">
	$('document').ready(function(){

		$('#upload_file').on('submit',function(event){
			event.preventDefault();
			$.ajax({
				url: "{{ route('doc.store') }}",
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
  $('.delete_file').on('click',function(e){
    e.preventDefault();
    var csrf = $('meta[name="csrf-token"]').attr('content');
    var str = $(this).attr('href');
    var id = str.slice(1);
    $.ajax({
      type:'delete',
      url:"{{url('/doc') . '/'}}" + id,
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