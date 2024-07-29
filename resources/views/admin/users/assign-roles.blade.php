@extends('admin.master')
@section('title','Create User')
@section('breadcrumb')
<a href="{{ route('user.index') }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')
<h3>{{$user->name}}</h3>
<form action="{{route('user.update_roles',$user)}}" method="post">
{{@csrf_field()}}
<input type="hidden" name="_method" value="put" />
@if($data->count() > 0)
@foreach($data as $row)
<input type="checkbox" class="_form-control" name="roles[]" value="{{$row->id}}" 
@if($user->roles->pluck('id')->contains($row->id)) checked @endif /> {{$row->role}} <br/>
@endforeach
@endif
<br>
<input type="submit" class="btn btn-primary btn-sm" value="Update Roles"/>
</form>
@endsection