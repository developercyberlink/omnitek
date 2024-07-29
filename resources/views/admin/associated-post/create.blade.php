@extends('admin.master')
@section('title','Post Category')
@section('breadcrumb')
    <a href="{{ url('admin/associated/'.Request::segment(3).'/'.Request::segment(4)) }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')
    <form class="form-horizontal" role="form" action="{{url('admin/associated/'.Request::segment(3).'/'.Request::segment(4).'/store')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-md-8">
            <!-- Input Fields -->
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Create Associated Post</span>
                </div>
                <div class="panel-body">
                    <input type="hidden" name="post_id" value="{{Request::segment(4)}}" />
                    <div class="form-group">
                        <label for="title" class="col-lg-3 control-label">Title</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="title" name="title" class="form-control" />
                                <input type="hidden" id="uri" name="uri" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-lg-3 control-label">Sub Title</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <textarea class="form-control my-editor" id="" name="sub-title" rows="3" autocomplete="off"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-3 control-label">Brief</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <div class="bs-component">
                                    <textarea class="form-control my-editor" id="" name="brief" rows="3" autocomplete="off"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-lg-3 control-label">Contact</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="ordering" name="phone" class="form-control"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-lg-3 control-label">Email</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="ordering" name="email" class="form-control"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-lg-3 control-label">Facebook Link</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="ordering" name="facebook_link" class="form-control"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-lg-3 control-label">Twitter Link</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="ordering" name="twitter_link" class="form-control"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-lg-3 control-label">LinkedIn Link</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="ordering" name="linked_in_link" class="form-control"/>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="title" class="col-lg-3 control-label">Ordering</label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" id="ordering" name="ordering" class="form-control" value="{{$ordering}}" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Icon</label>
                        <div class="col-lg-6">
                            <div class="bs-component">

                                <select id="template" name="icon" style="font-family: 'FontAwesome';">
                                    <option value="" selected>Choose Icon</option>
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('#title').on('keyup',function(){
                var title;
                title = $('#title').val();
                title=title.replace(/[^a-zA-Z0-9 ]+/g,"");
                title=title.replace(/\s+/g, "-");
                $('#uri').val(title);
            });
        });
    </script>
@endsection
