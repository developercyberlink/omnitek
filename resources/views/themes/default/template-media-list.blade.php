@extends('themes.default.common.master')
@section('post_title',$data->post_title)
@section('meta_keyword',$data->meta_keyword)
@section('meta_description',$data->meta_description)
@section('content')
    <!-- banner -->
    <section class="bg-primary uk-background-norepeat uk-background-top-right uk-background-image@s
   uk-position-relative uk-flex uk-flex-middle uk-text-left"
             uk-height-viewport="expand: true; min-height: 150;">
        <div class="uk-width-1-1 uk-position-z-index">
            <div class="uk-container text-white"
                 uk-scrollspy="cls: uk-animation-slide-top-small; target:h2;  delay: 100; repeat: false;">
                <h2 class="f-30 f-w-600  uk-margin-small">{{$data->post_title}}</h2>
            </div>
        </div>
    </section>
    <!-- end banner -->
    <!-- section -->
    <section class="uk-section bg-light">
        <div class="uk-container"
             uk-scrollspy="cls: uk-animation-slide-top-small; target:div, h1, a;  delay: 50; repeat: false;">

            <!--  -->
            <!--  -->
            <ul class="uk-grid-medium uk-child-width-1-3@m uk-child-width-1-2@s uk-child-width-1-2@s"
                uk-height-match="target:.uk-same-height" uk-grid>
                <!--  -->
                <!--  -->

                @if($data_child->count()>0)
                    @foreach($data_child as $row)
                        @if($row->external_link)
                            <li>
                                <div class=" bg-white uk-box-shadow-medium uk-bordered-rounded uk-overflow-hidden">

                                    <div class="open-video" data-youtube-id="{{$row->external_link}}">
                                        <div
                                            class="uk-media-250 uk-position-relative uk-pointer-left uk-pointer-left-primary uk-same-height">
                                            <div class="uk-overlay-primary uk-position-cover"></div>
                                            <img
                                                src="https://img.youtube.com/vi/{{$row->external_link}}/maxresdefault.jpg">
                                            <div class="uk-position-center uk-zindex">
                                                <i class="fa fa-play fa-2x text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- if video -->
                                    <div class="uk-border-left-on-hover uk-padding uk-same-height">
                            <span
                                class="uk-display-block uk-text-muted f-14 f-w-400 uk-margin-small-bottom">{{$row->updated_at->format('d M Y')}}</span>
                                        <h1 class="f-20 f-w-400 uk-margin-remove"><a
                                                href="{{url(geturl($row['uri'],$row['page_key']))}}">
                                                {{$row->post_title}}</a></h1>
                                    </div>
                                </div>
                            </li>
                        @else
                            <li>
                                <div class="bg-white uk-box-shadow-medium uk-bordered-rounded uk-overflow-hidden ">
                                    <div class="uk-media-250 uk-position-relative">
                                        <a href="{{url(geturl($row['uri'],$row['page_key']))}}">
                                            <img src="{{asset('uploads/original/' . $row->page_thumbnail)}}">
                                        </a>
                                    </div>
                                    <div class="uk-position-relative uk-border-left-on-hover uk-padding uk-same-height">
                                    <span
                                        class="uk-display-block uk-text-muted f-14 f-w-400 uk-margin-small-bottom">{{$row->updated_at->format('d M Y')}}</span>
                                        <h1 class="f-20 f-w-400 uk-margin-remove"><a
                                                href="{{url(geturl($row['uri'],$row['page_key']))}}">{{$row->post_title}}</a>
                                        </h1>
                                    </div>
                                </div>
                            </li>
                    @endif

                @endforeach
            @endif
            <!--  -->

            </ul>
            <!--  -->
        </div>
    </section>
    <!-- section -->
    <nav>
        <ul class="pagination">
            {{$data_child->links()}}

        </ul>
    </nav>
@stop
