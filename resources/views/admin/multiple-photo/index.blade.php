@extends('admin.master')
@section('breadcrumb')
     <a href="{{ route('admin.multiplephoto.create',Request::segment(2)) }}" class="btn btn-primary btn-sm">Create</a>
@endsection
@section('content')
@if($data->count() > 0)
@foreach($data as $row)
<div class="col-lg-2 id{{$row->id}}">
			<a href="#{{$row->id}}" class="delete_image" data-postid="{{Request::segment(2)}}">X</a>
			<img src="{{ asset('uploads/medium/'.$row->file_name) }}" alt="" width="200" /> 
		</div>
@endforeach
@endif
@endsection
@section('libraries')
<script type="text/javascript">
$('document').ready(function(){
$('.delete_image').on('click',function(e){
    e.preventDefault();
    var csrf = $('meta[name="csrf-token"]').attr('content');
    var str = $(this).attr('href');
    var id = str.slice(1);
    var post_id = $(this).attr('data-postid');
    var url = '{{ route("admin.multiplephoto.destroy",["post_id"=>':post_id',"id"=>':id']) }}';
    url = url.replace(':id', id);
    url = url.replace(':post_id', post_id);
    $.ajax({
      type:'delete',
      url:url,
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

