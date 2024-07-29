@extends('admin.master')
@section('title','Post Category')
@section('breadcrumb')

@endsection
@section('content')
    <form class="form-horizontal" role="form" action="{{url('admin/associated/'.Request::segment(3).'/'.Request::segment(4))}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT" />
        <div class="col-md-8">
            <!-- Input Fields -->
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Edit Associated Post</span>
                </div>
                <div class="panel-body">
                    <input type="hidden" name="post_id" value="{{Request::segment(4)}}" />
                    <div class="form-group">
                        <label for="title" class="col-lg-3 control-label">Title</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="title" name="title" class="form-control" value="{{$data->title}}" />
                            </div>
                        </div>
                    </div>
                    <label for="title" class="col-lg-3 control-label">Sub Title</label>
                    <div class="col-lg-8">
                        <div class="bs-component">
                            <input type="text" id="title" name="sub_title" class="form-control" value="{{$data->sub_title}}" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Brief</label>
                    <div class="col-lg-8">
                        <div class="bs-component">
                            <div class="bs-component">
                                <textarea class="form-control my-editor" id="" name="brief" rows="3" autocomplete="off">{{$data->brief}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title" class="col-lg-3 control-label">Contact</label>
                    <div class="col-lg-8">
                        <div class="bs-component">
                            <input type="text" id="ordering" name="phone" value="{{$data->phone}}" class="form-control"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title" class="col-lg-3 control-label">Email</label>
                    <div class="col-lg-8">
                        <div class="bs-component">
                            <input type="text" id="ordering" name="email"  value="{{$data->email}}" class="form-control"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title" class="col-lg-3 control-label">Facebook Link</label>
                    <div class="col-lg-8">
                        <div class="bs-component">
                            <input type="text" id="ordering" name="facebook_link" value="{{$data->facebook_link}}" class="form-control"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title" class="col-lg-3 control-label">Twitter Link</label>
                    <div class="col-lg-8">
                        <div class="bs-component">
                            <input type="text" id="ordering" name="twitter_link" value="{{$data->twitter_link}}" class="form-control"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title" class="col-lg-3 control-label">LinkedIn Link</label>
                    <div class="col-lg-8">
                        <div class="bs-component">
                            <input type="text" id="ordering" name="linked_in_link" value="{{$data->linked_in_link}}" class="form-control"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title" class="col-lg-3 control-label">Ordering</label>
                    <div class="col-lg-8">
                        <div class="bs-component">
                            <input type="text" id="ordering" name="ordering" class="form-control" value="{{$data->ordering}}" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Icon</label>
                    <div class="col-lg-8">
                        <div class="bs-component">

                            <select id="template" name="icon" style="font-family: 'FontAwesome';">
                                @if($data->icon != NULL)
                                    <option value="{{$data->icon}}" selected>{{$data->icon}}</option>
                                @else
                                    <option value="" selected>Choose Icon</option>
                                @endif
                                <option value="call3">&#xf095; EMERGENCY CALL </option>
                                <option value="calendar">&#xf133; CALENDAR </option>
                                <option value="health-report">&#xf15b; HEALTH REPORT </option>
                                <option value="heart">&#xf004; HEART-1 </option>
                                <option value="heart2">&#xf08a; HEART-2 </option>
                                <option value="heart3">&#xf21e; HEART-3 </option>
                                <option value="dropper">&#xf1fb; DROPPER </option>
                                <option value="ambulance">&#xf0f9; AMBULANCE </option>
                                <option value="first-aid-kit">&#xf0fa; FIRST AID KIT </option>
                                <option value="hospital">&#xf0f8; HOSPITAL </option>
                                <option value="expenses ">&#xf155; EXPENSES </option>
                                <option value="bandage">BANDAGE </option>
                                <option value="head"> HEAD </option>
                                <option value="microscope">MICROSCOPE </option>
                                <option value="drugs"> DRUGS</option>
                                <option value="doctor"> DOCTOR </option>

                            </select>  <i class="arrow"></i>

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Thumbnail</label>
                    <div class="col-lg-8">
                        <div class="bs-component">
                            <div class="bs-component">
                                <div id="xedit-demo">
                                    @if($data->thumbnail)
                                        <span class="id{{$data->id}}">
              <a href="#{{$data->id}}" class="imagedelete"></a>
              <img src="{{ asset(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail) }}" width="150" />
              </span>
                                        <hr>
                                    @endif
                                    <input type="file" name="thumbnail" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label" for=""> </label>
                    <div class="col-lg-8">
                        <div class="bs-component">
                            <input type="submit" class="btn btn-primary btn-lg" value="Submit" />
                        </div>
                    </div>
                </div>


            </div>
        </div>
        </div>

        <div class="col-md-4"> </div>
    </form>
@endsection
@section('scripts')
@endsection
