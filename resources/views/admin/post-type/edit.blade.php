@extends('admin.master')
@section('title','Post Type')
@section('breadcrumb')
 <a href="{{ route('type.posttype.index',Request::segment(2)) }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')
<form class="form-horizontal" role="form" action="{{ url('type/posttype', $data->id) }}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	<input type="hidden" name="_method" value="PUT" />
	<div class="col-md-12">
		<!-- Input Fields -->
		<div class="panel">
			<div class="panel-heading">
				<span class="panel-title">Edit Post Type</span>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="inputStandard" class="col-lg-2 control-label">Post Type</label>
					<div class="col-lg-8">
						<div class="bs-component">
							<input type="text" id="inputStandard" name="post_type" class="form-control" placeholder="" value="{{$data->post_type}}" />
						</div>
					</div>
				</div>


				<div class="form-group">
          <label for="inputSelect" class="col-lg-2 control-label"> Template </label>
          <div class="col-lg-8">

            <div class="bs-component">
              <select name="template" class="form-control">
                @if($templates)
                @foreach($templates as $key=>$template)
                <option value="{{$key}}" {{ ($template == $data->template)?'selected':'' }}> {{ ucfirst($template)}}</option>
                @endforeach
                @endif
              </select>
              <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div>
              </div>
            </div>
          </div>
				<div class="form-group">
					<label for="inputStandard" class="col-lg-2 control-label"> Uri</label>
					<div class="col-lg-8">
						<div class="bs-component">
							<input type="text" id="inputStandard" name="uri" class="form-control" placeholder="" value="{{$data->uri}}" readonly />
						</div>
					</div>
				</div>

		
				<div class="form-group">
        <label for="inputStandard" class="col-lg-2 control-label"> Caption </label>
        <div class="col-lg-8">
          <div class="bs-component">
          	 <textarea class="form-control" id="" name="caption" rows="3" autocomplete="off">{{$data->caption}}</textarea>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="inputStandard" class="col-lg-2 control-label"> Content </label>
        <div class="col-lg-8">
          <div class="bs-component">
            <textArea name="contents" class="my-editor form-control" rows="30" autocomplete="off"> {{$data->content}} </textArea>
          </div>
        </div>
      </div>

				<div class="form-group">
					<label for="inputStandard" class="col-lg-2 control-label"> Ordering </label>
					<div class="col-lg-8">
						<div class="bs-component">
							<input type="text" id="ordering" name="ordering" class="form-control" value="{{ $data->ordering }}" />
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="inputStandard" class="col-lg-2 control-label"> Is Menu ? </label>
					<div class="col-lg-8">
						<div class="bs-component">
							<select name="is_menu" class="form-control input-sm">
								<option value="0" {{($data->is_menu == '0')?'selected':''}}> No </option>
								<option value="1" {{($data->is_menu == '1')?'selected':''}}> Yes </option>
							</select>
						</div>
					</div>
				</div>

	<div class="form-group">
      <label class="col-lg-2 control-label" for="textArea3"> Banner </label>
      <div class="col-lg-8">
        <div class="bs-component">
            <div class="hd_show_con">
              <div id="xedit-demo">
               <input type="file" name="banner" />
             </div>
           </div>
           </div>
          @if($data->banner)
            <span class="bannerid{{$data->id}}">
          <a href="#{{$data->id}}" class="delete_banner">X</a>
		   <img src="{{asset(env('PUBLIC_PATH').'uploads/medium/' . $data->banner )}}" width="300" class="responsive" alt="{{ $data->post_type}}" />
		 </span>
		   @endif
		   </div>
         </div>

         
            <div class="form-group">
        <label for="inputStandard" class="col-lg-2 control-label"> Video ID</label>
        <div class="col-lg-8">
          <div class="bs-component">
            <input type="text" value="{{$data->uid}}" name="uid" class="form-control" placeholder="" />
          </div>
        </div>
      </div>


        <div class="form-group">
        <label for="inputStandard" class="col-lg-2 control-label"> Meta Keyword </label>
        <div class="col-lg-8">
          <div class="bs-component">
            <input type="text" id="meta_keyword" name="meta_keyword" class="form-control" value="{{$data->meta_keyword}}" />
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="inputStandard" class="col-lg-2 control-label"> Meta Description </label>
        <div class="col-lg-8">
          <div class="bs-component">
            <input type="text" id="meta_description" name="meta_description" class="form-control" value="{{$data->meta_description}}" />
          </div>
        </div>
      </div>


				<div class="form-group">
					<label class="col-lg-2 control-label" for="textArea3">  </label>
					<div class="col-lg-8">
						<div class="bs-component">
							<input type="submit" class="btn btn-primary btn-md" value="Submit" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</form>
@endsection
@section('libraries')
    <script type="text/javascript">
 
  /****************/
  $('.delete_banner').on('click',function(e){
    e.preventDefault();
    if(!confirm('Are you sure to delete?')) return false;
    var csrf = $('meta[name="csrf-token"]').attr('content');
    var str = $(this).attr('href');
    var id = str.slice(1);
    $.ajax({
      type:'delete',
      url:"{{url('delete_posttype_banner') . '/'}}" + id,
      data:{_token:csrf},
      success:function(data){
        $('span.bannerid' + id ).remove();
      },
      error:function(data){
      alert(data + 'Error!');
     }
   });
  });

  </script>
  @endsection
