@extends('admin.master')
@section('title','Edit User')
@section('breadcrumb')
<a href="{{ route('user.index') }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add/Edit Menu Permission -  {{ $user->name }}</div>

                <div class="panel-body">
                <form action="{{route('user.permissionUpdate',$user)}}" method="post">
                {{@csrf_field()}}
<input type="hidden" name="_method" value="put" />
                @if($data->count() > 0)
                @foreach($data as $row)
                        <div class="form-group">                           
                            <div class="col-md-12"> 
                                <input type="checkbox" class="col-md-1 addpermission" name="adminmenu_id[]" value="{{ $row->id }}"
                                @if($user->adminmenu->pluck('id')->contains($row->id)) checked @endif />                    
                                <label for="title" class="col-md-7 control-label">{{$row->title}}</label>
                            </div>
                            
                        </div> 
                @endforeach        
                @endif        
       
                <br>
<input type="submit" class="btn btn-primary btn-sm" value="Update Admin Menu"/>
</form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
// jQuery(document).ready(function() {
//   $('.addpermission').on('click',function(e){
//     e.preventDefault();
//     var csrf = $('meta[name="csrf-token"]').attr('content');
// 	var adminmenu_id = $(this).val();
//     var user_id = '{{--Request::segment(2)--}}';
// 	var url = '{{--route("adminmenu.permission_update",["user_id"=>':user_id',"adminmenu_id"=>':adminmenu_id'])--}}';
//         url = url.replace(':user_id',user_id);
//         url = url.replace(':adminmenu_id',adminmenu_id);
//     $.ajax({
//       type:'post',
//       url:url,
//       data:{_token:csrf},    
//       success:function(data){ 
//         console.log(data);
//       },
//       error:function(data){       
//         console.log(data);
//      }
//    });
//   });
// });
  </script>
@endsection