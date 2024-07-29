@extends('themes.default.common.master')
@section('post_title',$data->post_title)
@section('meta_keyword',$data->meta_keyword)
@section('meta_description',$data->meta_description)
@section('content')
    <!-- header -->
    <section
        class="uk-cover-container  uk-position-relative uk-flex uk-flex-middle uk-background-norepeat uk-background-cover"
        style="background:url({{asset('uploads/medium/' . $data->banner)}});">
        <div class="uk-overlay-primary  uk-position-cover "></div>
        <div class="uk-home-banner uk-width-1-1 uk-position-z-index"
             uk-scrollspy="cls: uk-animation-slide-top-small; target:a, li, h1, p;  delay: 100; repeat: false;">
            <div class="uk-container uk-container-large uk-position-relative text-white uk-flex-middle uk-flex"
                 uk-height-viewport="expand: true; min-height: 400;">
                <div class="uk-width-1-2@m uk-text-left">
                    <div class="uk-light">
                        <ul class="uk-breadcrumb">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><span>{{$data->post_type}}</span></li>
                        </ul>
                    </div>
                    <h1 class="uk-h1 uk-text-bold text-white uk-margin-small">{{$data->post_type}}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- end header -->
    <!-- section -->
    <section class="uk-section bg-pattern-02 uk-blog-list">
        <div class="uk-container uk-container-large"
             uk-scrollspy="cls: uk-animation-slide-top-small; target:div, h1, a;  delay: 100; repeat: false;">
            <!-- news block -->
            <div class="uk-grid-medium" uk-grid>
                <!--  -->
                @foreach($posts->take(1) as $row)
                    <div class="uk-width-expand@m">
                        <a href="{{url(geturl($row['uri'],$row['page_key']))}}" class="uk-article-list">
                            @if($row->page_thumbnail)
                            <div class="uk-article-list-image" style="background-image: url({{asset('uploads/medium/' . $row->page_thumbnail)}});">
                            @else
                            <div class="uk-article-list-image" style="background-image: url({{asset('images/default.png')}});">
                            @endif
                                <div class="uk-article-category">
                                    {{show_category($row->post_category)}}
                                </div>
                                <div class="uk-article-dec">
                                    <h1 class="uk-h4 uk-text-normal uk-margin-remove text-white">{{$row->post_title}}</h1>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            <!--  -->
                <!--  -->
                @foreach($posts->skip(1)->take(2) as $row)
                    <div class="uk-width-1-4@m">
                        <a href="{{url(geturl($row['uri'],$row['page_key']))}}" class="uk-article-list">
                             @if($row->page_thumbnail)
                            <div class="uk-article-list-image" style="background-image: url({{asset('uploads/medium/' . $row->page_thumbnail)}});">
                            @else
                            <div class="uk-article-list-image" style="background-image: url({{asset('images/default.png')}});">
                            @endif
                                <div class="uk-article-category">{{show_category($row->post_category)}}</div>
                                <div class="uk-article-dec">
                                    <h1 class="uk-h4 uk-text-normal uk-margin-remove text-white">
                                        {{$row->post_title}}
                                    </h1>
                                </div>
                            </div>
                        </a>
                    </div>
            @endforeach
            <!--  -->

                <!--  -->
            </div>
            <!-- news block -->
            <!--  -->
            <ul class="uk-grid-medium uk-child-width-1-3@m uk-child-width-1-2@s uk-child-width-1-2@s"
                uk-height-match="target:.uk-same-height" uk-grid>
                <!--  -->
                @foreach($posts->skip(3)->take(3) as $row)

                    <li>
                        <div class=" bg-white uk-box-shadow-medium uk-article-list">
                            @if($row->external_link)
                                <div class="open-video" data-youtube-id="{{$row->external_link}}">
                                    <div class="uk-media-250 uk-position-relative uk-same-height">
                                        <div class="uk-overlay-primary uk-position-cover"></div>
                                        <div class="uk-position-center-top">
                                            <div
                                                class="uk-article-category bg-primary">{{show_category($row->post_category)}}</div>
                                        </div>
                                        <img src="https://img.youtube.com/vi/{{$row->external_link}}/maxresdefault.jpg">
                                        <div class="uk-position-center uk-zindex">
                                            <i class="fa fa-play fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="uk-media-250 uk-position-relative">
                                    <a href="{{url(geturl($row['uri'],$row['page_key']))}}">
                                        <div class="uk-overlay-primary uk-position-cover"></div>
                                        <div class="uk-position-center-top">
                                            <div class="uk-article-category bg-primary">{{show_category($row->post_category)}}</div>
                                        </div>
                                         @if($row->page_thumbnail)
                                        <img src="{{asset('uploads/medium/' . $row->page_thumbnail)}}">
                                        @else
                                        <img src="({{asset('images/default.png')}})">
                                        @endif
                                      
                                    </a>
                                </div>
                        @endif
                        <!-- if video -->
                            <div class=" uk-padding uk-same-height">
                                <h1 class="f-20 f-w-400 uk-margin-remove"><a href="{{url(geturl($row['uri'],$row['page_key']))}}">{{$row->post_title}}</a>
                                </h1>
                            </div>
                        </div>
                    </li>
                <!--  -->
            @endforeach
            <!--  -->
            </ul>
            <!--  -->
        </div>
    </section>
    <!-- section -->
    <nav>
        <ul class="pagination">
            {{$posts->links()}}
        </ul>
    </nav>
@stop