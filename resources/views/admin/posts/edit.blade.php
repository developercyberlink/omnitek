@extends('admin.master')
@section('title', Request::segment(2))
@section('breadcrumb')
    <a href="{{ route('admin.post.index', Request::segment(2)) }}" class="btn btn-primary btn-sm">List</a>
    <a href="{{ route('admin.post.index', Request::segment(2)) }}/create" class="btn btn-primary btn-sm">Create</a>
@endsection
@section('content')
    <form class="form-horizontal" role="form" action="{{ url('admin/'.Request::segment(2).'/'.$data->id) }}"
          method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT"/>
        <input type="hidden" name="post_type" value="{{ Request::segment(2) }}"/>
        <input type="hidden" name="post_date" value="<?=date('Y-m-d h:i:s')?>"/>
        <div class="col-md-9">
            <!-- Input Fields -->
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Edit Post</span>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label">Title</label>
                        <div class="col-lg-9">
                            <div class="bs-component">
                                <input type="text" id="post_title" name="post_title" class="form-control"
                                       value="{{$data->post_title}}"/>
                                <input type="hidden" id="uri" name="uri" class="form-control" value="{{$data->uri}}"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label">Sub Title</label>
                        <div class="col-lg-9">
                            <div class="bs-component">
                                <input type="text" id="" name="sub_title" class="form-control"
                                       value="{{$data->sub_title}}"/>
                            </div>
                        </div>
                    </div>
                    @if(Request::segment(2) == 'find-a-doctor')
                        <div class="form-group">
                            <label for="inputStandard" class="col-lg-2 control-label">Facebook Link</label>
                            <div class="col-lg-9">
                                <div class="bs-component">
                                    <input type="text" id="" name="uid" class="form-control" value="{{$data->uid}}"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="textArea3"> Twitter Link </label>
                            <div class="col-lg-9">
                                <div class="bs-component">
                                    <input type="text" class="form-control" id="" name="associated_title"
                                           value="{{$data->associated_title}}"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="textArea3"> Contact </label>
                            <div class="col-lg-9">
                                <div class="bs-component">
                                    <input type="text" class="form-control" id="" name="post_tags"
                                           value="{{$data->post_tags}}"/>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="inputSelect" class="col-lg-2 control-label"> Category </label>
                        <div class="col-lg-9">
                            <div class="bs-component">

                                <select name="category" class="form-control">
                                    <option value="0"> Select Category</option>
                                    @if($category)
                                        @foreach($category as $row)
                                            <option
                                                value="{{$row->id}}" {{ ($row->id == $data->post_category )?'selected':'' }}> {{$row->category}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt;
                                    &gt;
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($parent_post->count() > 0)
                        <div class="form-group">
                            <label for="inputSelect" class="col-lg-2 control-label">Select Parent</label>
                            <div class="col-lg-9">
                                <div class="bs-component">
                                    <select name="post_parent" class="form-control">
                                        <option value="0"> Choose Parent</option>
                                        @foreach($parent_post as $row)

                                            @if($row->id == $data->id)
                                                @continue
                                            @endif

                                            <option
                                                value="{{$row->id}}" {{ ($row->id == $data->post_parent)?'selected':'' }}>{{$row->post_title}}</option>
                                            @if(has_child_post($row->id))
                                                @foreach(has_child_post($row->id) as $child_row)
                                                    <option
                                                        value="{{$child_row->id}}" {{ ($child_row->id == $data->post_parent)?'selected':'' }}>
                                                        —> {{$child_row->post_title}}</option>
                                                    @if(has_child_post($child_row->id))
                                                        @foreach(has_child_post($child_row->id) as $grand_child_row)
                                                            <option
                                                                value="{{$grand_child_row->id}}" {{ ($grand_child_row->id == $data->post_parent)?'selected':'' }}>
                                                                — —> {{$grand_child_row->post_title}}</option>
                                                            @if(has_child_post($grand_child_row->id) )
                                                                @foreach(has_child_post($grand_child_row->id) as $grand_child_row_x)
                                                                    <option
                                                                        value="{{$grand_child_row_x->id}}" {{ ($grand_child_row_x->id == $data->post_parent)?'selected':'' }}>
                                                                        — —
                                                                        —> {{$grand_child_row_x->post_title}}</option>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                    <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt;
                                        &gt;
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="textArea3"> Brief </label>
                        <div class="col-lg-9">
                            <div class="bs-component">
                                <textarea class="form-control my-editor" id="" name="post_excerpt"
                                          rows="3"> {{$data->post_excerpt}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="textArea2">Content</label>
                        <div class="col-lg-10">
                            <div class="bs-component">
                                <textarea class="form-control my-editor" id="editor2" name="post_content"
                                          rows="30"> {{$data->post_content}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label">Meta Key</label>
                        <div class="col-lg-9">
                            <div class="bs-component">
                                <input type="text" id="" name="meta_keyword" class="form-control"
                                       value="{{$data->meta_keyword}}"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="textArea3"> Meta Description </label>
                        <div class="col-lg-9">
                            <div class="bs-component">
                                <textarea class="form-control" id="" name="meta_description"
                                          rows="3">{{$data->meta_description}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label"> External Link </label>
                        <div class="col-lg-9">
                            <div class="bs-component">
                                <input type="text" id="" name="external_link" class="form-control"
                                       value="{{$data->external_link}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label">Deadline </label>
                        <div class="col-lg-9">
                            <div class="bs-component">
                                <input type="text" id="" name="deadline" class="form-control"
                                       value="{{$data->deadline}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label"> Job type </label>
                        <div class="col-lg-9">
                            <div class="bs-component">
                                <input type="text" id="" name="job_category" class="form-control"
                                       value="{{$data->job_category}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label"> Employment Type </label>
                        <div class="col-lg-9">
                            <div class="bs-component">
                                <input type="text" id="" name="employment_type" class="form-control"
                                       value="{{$data->employment_type}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-2 control-label"> NO of Vacancy </label>
                        <div class="col-lg-9">
                            <div class="bs-component">
                                <input type="text" id="" name="no_of_vacancy" class="form-control"
                                       value="{{$data->no_of_vacancy}}"/>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="admin-form">
                <div class="sid_ mb10">
                    <div class="hd_show_con">
                        <div class="publice_edi">
                            Status: <span class="text-primary">{{ ($data->status == 1)?'Active':'InActive' }}</span>
                        </div>
                    </div>
                    <footer>
                        <div id="publishing-action">
                            <input type="submit" class="btn btn-primary btn-sm" value="Update"/>
                        </div>
                        <div class="clearfix"></div>
                    </footer>
                    <div class="clearfix"></div>
                </div>

                <div class="sid_ mb10">
                    <label class="field select">
                        <select id="template" name="template">
                            @foreach($templates as $key=>$template)
                                <option
                                    value="{{$key}}" {{ ($template == $data->template)?'selected':'' }} >{{ ucfirst($template) }} </option>
                            @endforeach
                        </select>
                        <i class="arrow"></i>
                    </label>
                </div>
            <!--
          <div class="sid_ mb10">
            <label class="field select">
              <select id="template_child" name="template_child">
               @foreach($templates_child as $key=>$template_child)
                <option value="{{$key}}" {{ ($template_child == $data->template_child)?'selected':'' }} >{{ ucfirst($template_child) }} </option>
               @endforeach
                </select>
                <i class="arrow"></i>
              </label>
            </div> -->

                <div class="sid_ mb10">
                    <label class="field text"> Post Order
                        <input type="number" id="" name="post_order" class="form-control" placeholder="Post Order"
                               value="{{$data->post_order}}"/>
                    </label>
                </div>

                <div class="sid_ mb10">
                    <label class="field text"> Homepage Order
                        <input type="number" id="" name="home_order" class="form-control"
                               placeholder="Insert Order Here" value="{{$data->home_order}}"/>
                    </label>
                </div>

                <div class="sid_ mb10">
                    <div class="hd_show_con">
                        <input type="checkbox" name="show_in_home"
                               value="{{ $data->show_in_home }}" {{ ($data->show_in_home == 1)?'checked':'' }} />
                        Show in home <br>
                    </div>
                </div>
                <div class="sid_ mb10">
                    <h4> Icon </h4>
                    <label class="field select">
                        <select id="template" name="price" style="font-family: 'FontAwesome';">
                            @if($data->price != NULL)
                                <option value="{{$data->price}}" selected>{{$data->price}}</option>
                            @else
                                <option value="" selected>Choose Icon</option>
                            @endif
                            <option value="coins">&#xf1c0; COINS</option>
                            <option value="chart-bar">&#xf080; BAR</option>
                            <option value="chart-line">&#xf201; LINE</option>
                            <option value="newspaper">&#xf1ea; NEWSPAPER</option>
                            <option value="user-plus">&#xf007; USER PLUS</option>
                            <option value="briefcase">&#xf0b1; BRIEFCASE</option>
                            <option value="lightbulb">&#xf0eb; LIGHTBULB</option>
                            <option value="glasses">&#xf000; GLASSESS</option>
                            <option value="clock">&#xf017; CLOCK</option>
                            <option value="bullseye">&#xf140; BULLSEYE</option>
                            <option value="wallet">&#xf07b; WALLET</option>
                            <option value="star"> &#xf005; STAR</option>
                            <option value="handshake"> HANDSHAKE</option>
                            <option value="fingerprint">FINGERPRINT</option>


                        </select> <i class="arrow"></i>
                    </label>
                </div>

                <div class="sid_ mb10">
                    <h4>Related Publication </h4>
                    <label class="field select">
                        <select id="publication" name="publication[]" multiple style="font-family: 'FontAwesome';">
                            {{--                            @foreach($post as $value)--}}
                            {{--                                @foreach($data->related_publications as $row)--}}
                            {{--                                    @if($value->id==$row->pivot->post_id)--}}
                            {{--                                        <option value="{{$row->id}}" selected>{{$row->post_title}}</option>--}}
                            {{--                                    @else--}}
                            {{--                                        <option value="{{$row->id}}">{{$row->post_title}}</option>--}}
                            {{--                                    @endif--}}


                            {{--                                @endforeach--}}
                            {{--                            @endforeach--}}
                            @foreach($publication as $value)
                                <option
                                    @if(\Illuminate\Support\Facades\DB::table('post_related_publication')
                       ->where('post_id',$data->id)
                       ->where('publication_id',$value->id)->first()) selected @endif
                                value="{{$value->id}}">
                                    {{$value->post_title}}</option>
                            @endforeach
                        </select> <i class="arrow"></i>
                    </label>
                </div>

                <?php /* ?>
       <div class="sid_ mb10">
          <h4> Icon </h4>
            <div class="hd_show_con">
            <div id="xedit-demo">
              @if($data->icon)
              <span class="iconid{{$data->id}}">
              <a href="#{{$data->id}}" class="delete_icon">X</a>
              <img src="{{ asset(env('PUBLIC_PATH').'uploads/medium/' . $data->icon) }}" width="150" />
              <hr>
              </span>
              @endif
             <input type="file" name="icon" />
            </div>
          </div>
        </div>


        <div class="sid_ mb10">
          <h4> Thumbnail </h4>
            <div class="hd_show_con">
            <div id="xedit-demo">
              @if($data->thumbnail)
              <span class="thumbnailid{{$data->id}}">
              <a href="#{{$data->id}}" class="delete_thumbnail">X</a>
              <img src="{{ asset(env('PUBLIC_PATH').'uploads/medium/' . $data->thumbnail) }}" width="150" />
              <hr>
              </span>
              @endif
             <input type="file" name="thumbnail" />
            </div>
          </div>
        </div>
<?php */?>
                <div class="sid_ mb10">
                    <h4> Featured Image </h4>
                    <div class="hd_show_con">
                        <div id="xedit-demo">
                            @if($data->page_thumbnail)
                                <span class="page_thumbnailid{{$data->id}}">
              <a href="#{{$data->id}}" class="delete_pagethumbnail">X</a>
              <img src="{{ asset(env('PUBLIC_PATH').'uploads/medium/' . $data->page_thumbnail) }}" width="150"/>
              <hr>
              </span>
                            @endif
                            <input type="file" name="page_thumbnail"/>
                        </div>
                    </div>
                </div>

                <div class="sid_ mb10">
                    <h4> Banner </h4>
                    <div class="hd_show_con">
                        <div id="xedit-demo">
                            @if($data->banner)
                                <span class="bannerid{{$data->id}}">
              <a href="#{{$data->id}}" class="delete_banner">X</a>
              <img src="{{ asset(env('PUBLIC_PATH').'uploads/medium/' . $data->banner) }}" width="150"/>
              <hr>
              </span>
                            @endif
                            <input type="file" name="banner"/>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection

@section('libraries')
    <script type="text/javascript">
        $('.delete_icon').on('click', function (e) {
            e.preventDefault();
            if (!confirm('Are you sure to delete?')) return false;
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var str = $(this).attr('href');
            var id = str.slice(1);
            $.ajax({
                type: 'delete',
                url: "{{url('delete_icon') . '/'}}" + id,
                data: {_token: csrf},
                success: function (data) {
                    $('span.iconid' + id).remove();
                },
                error: function (data) {
                    alert(data + 'Error!');
                }
            });
        });
        /****************/
        $('.delete_thumbnail').on('click', function (e) {
            e.preventDefault();
            if (!confirm('Are you sure to delete?')) return false;
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var str = $(this).attr('href');
            var id = str.slice(1);
            $.ajax({
                type: 'delete',
                url: "{{url('delete_thumbnail') . '/'}}" + id,
                data: {_token: csrf},
                success: function (data) {
                    $('span.thumbnailid' + id).remove();
                },
                error: function (data) {
                    alert(data + 'Error!');
                }
            });
        });
        /**************/
        $('.delete_pagethumbnail').on('click', function (e) {
            e.preventDefault();
            if (!confirm('Are you sure to delete?')) return false;
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var str = $(this).attr('href');
            var id = str.slice(1);
            $.ajax({
                type: 'delete',
                url: "{{url('delete_pagethumbnail') . '/'}}" + id,
                data: {_token: csrf},
                success: function (data) {
                    $('span.page_thumbnailid' + id).remove();
                },
                error: function (data) {
                    alert(data + 'Error!');
                }
            });
        });
        /****************/
        $('.delete_banner').on('click', function (e) {
            e.preventDefault();
            if (!confirm('Are you sure to delete?')) return false;
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var str = $(this).attr('href');
            var id = str.slice(1);
            $.ajax({
                type: 'delete',
                url: "{{url('delete_banner') . '/'}}" + id,
                data: {_token: csrf},
                success: function (data) {
                    $('span.bannerid' + id).remove();
                },
                error: function (data) {
                    alert(data + 'Error!');
                }
            });
        });

        //
        $(document).ready(function () {
            $('#post_title').on('keyup', function () {
                var post_title;
                post_title = $('#post_title').val();
                post_title = post_title.replace(/[^a-zA-Z0-9 ]+/g, "");
                post_title = post_title.replace(/\s+/g, "-");
                $('#uri').val(post_title);
            });
        });


    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#publication').select2();
        });
    </script>
@endsection
