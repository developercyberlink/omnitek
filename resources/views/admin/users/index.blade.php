@extends('admin.master')
@section('title','Dashboard')
@section('breadcrumb')
<a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">Create</a>
@endsection
@section('content')
@if($data)
<h2>User List</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">SN</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Pin</th>
      <th scope="col">Roles</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  @foreach($data as $row)
    <tr class="id{{$row->id}}">
      <th scope="row"> {{$loop->iteration}} </th>
      <td>{{$row->name}}</td>
      <td>{{$row->email}}</td>
      <td>{{$row->pin}}</td>
      <td>{{ implode(', ',$row->roles()->get()->pluck('role')->toArray()) }}
      </td>
      <td> 
      <a href="{{route('user.permissionEdit',$row->id)}}" class="btn btn-info btn-sm"> Assing Menu </a>
      <a href="{{route('user.assignroles',$row->id)}}" class="btn btn-info btn-sm">Assign Roles</a>
      <a href="{{route('user.edit',$row->id)}}" class="btn btn-primary btn-sm">Edit</a>
      <a data-userid="{{$row->id}}" class="btn btn-danger btn-sm btn-delete">Delete</a>     
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endif
@endsection
@section('scripts')
<script type="text/javascript">
jQuery(document).ready(function() {
  $('.btn-delete').on('click',function(e){
    e.preventDefault();
    if(!confirm('Are you sure to delete?')) return false;
    var csrf = $('meta[name="csrf-token"]').attr('content');
	var id = $(this).attr('data-userid');
	var url = '{{route("user.destroy",':id')}}';
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