@extends('admin.master')
@section('title','Post')

@section('breadcrumb')
<a href="{{route('tender-category.index')}}" class="btn btn-primary btn-sm">List</a>
@endsection

@section('content')
<form class="form-horizontal" role="form" action="{{ route('tender-category.store') }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}    
  <div class="col-md-9">
    <!-- Input Fields -->

    <div class="panel">
      <div class="panel-heading">
        <span class="panel-title"> Tender Category </span>
      </div>

      <div class="panel-body">                 
        <div class="form-group">
          <label for="inputStandard" class="col-lg-3 control-label">Tender Category</label>
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" id="" name="tender_category" class="form-control" placeholder="" />
            </div>
          </div>
        </div>

<div class="form-group">
          <label for="inputStandard" class="col-lg-3 control-label"></label>
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="submit" class="btn btn-primary btn-sm" value="Publish" />
            </div>
          </div>
        </div>


        </div>

      </div>          
    </div>
</form>

@endsection
