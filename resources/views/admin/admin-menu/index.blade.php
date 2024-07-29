@extends('admin.master')
@section('breadcrumb')
     <a href="{{ route('adminmenu.create') }}" class="btn btn-primary btn-sm">Create</a>
@endsection
@section('content')
<h2>Admin Menu</h2>
<div class="tray tray-center" style="height: 647px;">
<div class="panel">         
	<div class="panel-body ph20">
		<div class="tab-content">
			<div id="users" class="tab-pane active">
				<div class="table-responsive mhn20 mvn15">
					<table class="table admin-form theme-warning fs13">
						<thead>
							<tr class="bg-light">
								<th class="">SN</th>
								<th class="">Title</th>                            
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
           
							@foreach($data as $row)
							<tr class="id{{$row->id}}">
								<td class="">{{$loop->iteration}}</td>
								<td class="">{{ ucfirst($row->title) }}</td>
								<td class="text-center"> 								
									<a href="{{ route('adminmenu.edit',$row->id) }}">Edit</a> |
									<a href="#{{$row->id}}" class="btn-delete">Delete</a>
								</td> 
							</tr>
							@endforeach

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
	var url = '{{route("adminmenu.destroy",':id')}}';
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