@extends('admin.master')
@section('breadcrumb')
     <a href="/admin/{{ Request::segment(2) }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')
<form class="form-horizontal" role="form" action="{{ url('admin/imagegallery', $data->id )}}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}         
	<input type="hidden" name="_method" value="PUT" />   
	<div class="col-md-8">
		<!-- Input Fields -->
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Edit Gallery Image  </span>
			</div>
			<div class="panel-body"> 

				<div class="form-group">
                    <label for="inputSelect" class="col-lg-3 control-label">Category </label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        <select class="form-control" name="category_id">
                         @foreach($category as $row)
                         <option value="{{$row->id}}" {{($row->id == $data->category_id)? 'selected':'' }}> {{$row->category}} </option>
                         @endforeach
                        </select>
                      <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
                    </div>
                  </div>

				<div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label">Picture </label>
					<div class="col-lg-8">
						<div class="bs-component">
							<input type="file" id="inputStandard" name="picture" class="form-control" placeholder="" />
						</div>
					</div>
				</div>  

				  @if($data->picture != '')
                  <div class="form-group">
                    <label class="col-lg-3 control-label" for="gallery"></label>
                    <div class="col-lg-6">
                      <div class="bs-component">
                        <img src="{{url(env('PUBLIC_PATH').'/uploads/galleries/' . $data->picture )}}" width="400" height="200" />
                      </div>
                    </div>
                  </div>                    
                  @endif  

				<div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label">Caption </label>
					<div class="col-lg-8">
						<div class="bs-component">
							<input type="text" id="inputStandard" name="caption" class="form-control" value="{{$data->caption}}" />
						</div>
					</div>
				</div>         

				<div class="form-group">
					<label class="col-lg-3 control-label" for="textArea3"> </label>
					<div class="col-lg-8">
						<div class="bs-component">
							<input type="submit" class="btn btn-primary btn-lg" value="Submit" />
						</div>
					</div>
				</div> 


			</div>
		</div>          
	</div>

</form>
@endsection