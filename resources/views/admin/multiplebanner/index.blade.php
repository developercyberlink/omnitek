@extends('admin.master')
@section('title','Banner')
@section('breadcrumb')
     <a href="{{route('admin.multiplebanner.create',Request::segment(2))}}" class="btn btn-primary btn-sm">Create</a>
@endsection
@section('content')
<h5>Child Banner/Popup</h5>
<div class="tray tray-center" style="height: 647px;">
<div class="panel">         
	<div class="panel-body ph20">
		<div class="tab-content">

			<div id="users" class="tab-pane active">
				<div class="table-responsive mhn20 mvn15">

					<table class="table admin-form theme-warning fs13">
						<thead>
							<tr class="bg-light">
								<th>SN</th>
								<th>Title</th>                                                  
								<th>Created at</th>                            
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							@if(count($data) > 0)	            
							@foreach($data as $row)
							<tr class="id{{$row->id}}">
								<td>{{$loop->iteration}}</td>
								<td>{{ ucfirst($row->title) }}</td>
								<td>{{ ucfirst($row->created_at) }}</td>
								<td class="text-center">  
									<a href="{{ route('admin.multiplebanner.edit',['banner_id'=>Request::segment(2),'id'=>$row->id]) }}">Edit</a> |
									<a href="#{{$row->id}}" data-bannerid="{{Request::segment(2)}}" class="btn-delete">
										Delete
									</a>
								</td>
							</tr>
							@endforeach
							@endif  
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
jQuery(document).ready(function() {
  $('.btn-delete').on('click',function(e){
    e.preventDefault();
    if(!confirm('Are you sure to delete?')) return false;
    var csrf = $('meta[name="csrf-token"]').attr('content');
    var str = $(this).attr('href');
    var id = str.slice(1);
	var banner_id = $(this).attr('data-bannerid');
	var url = '{{ route("admin.multiplebanner.destroy",["banner_id"=>':banner_id',"id"=>':id']) }}';
	url = url.replace(':banner_id',banner_id);
	url = url.replace(':id',id);
    $.ajax({
      type:'DELETE',
      url:url,
      data:{_token:csrf},    
      success:function(data){ 
        $('tbody tr.id' + id ).remove();
      },
      error:function(data){       
       alert('Error occurred!');
     }
   });
  });
});
  </script>
@endsection