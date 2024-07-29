@extends('themes.default.common.master')
@section('post_title',$data->post_title)
@section('meta_keyword',$data->meta_keyword)
@section('meta_description',$data->meta_description)
@section('content')
    <!-- section -->
    <section class="uk-section uk-position-relative">
        <div class="uk-container uk-container-large uk-position-relative">
            <div class="uk-grid-large" uk-grid
                 uk-scrollspy="cls: uk-animation-slide-top-small; target:div, p, h1, h2, h3, h4, h5, h6, a;  delay: 50; repeat: false;">
                <div class="uk-width-expand@m">
                    <h1 class="uk-h2 f-w-600 uk-margin">{{$data->post_title}}</h1>
                    <!--  -->
                    <div class="uk-border-light-top uk-border-light-bottom uk-margin-bottom uk-padding-small">
                        <div class="uk-child-width-expand@s uk-flex-middle" uk-grid>
                            <div class="uk-text-muted"><i
                                    class="fa fa-clock-o"></i> {{$data->updated_at->format('d M Y')}}</div>
                            <div>
                                <!-- ShareThis BEGIN -->
                                <div class="sharethis-inline-share-buttons"></div>
                                <!-- ShareThis END -->
                            </div>
                        </div>
                    </div>

                    <!--if video -->
                    @if($data->external_link)
                        <figure class="uk-feature-video uk-margin-medium-bottom">
                            <iframe width="100%" height="500"
                                    src="https://www.youtube.com/embed/{{$data->external_link}}"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            <figcaption class="f-14">{{$data->post_title}}</figcaption>
                        </figure>
                    @else
                    <!--  -->
                        <figure class="uk-feature-image uk-margin-medium-bottom" uk-lightbox="">
                            <a href="{{asset('uploads/original/' . $data->banner)}}"
                               data-caption="{{$data->post_title}}">
                                <img src="{{asset('uploads/original/' . $data->banner)}}" alt=""> </a>
                            <figcaption class="f-14">{{$data->post_title}}</figcaption>
                        </figure>
                    @endif
                <!-- end if video -->
                    {!! $data->post_content !!}

                </div>
                <div class="uk-width-1-3@l">
                    <h1 class="uk-h4 f-w-600">Related</h1>
                    <!--  -->
                    <ul class="uk-grid-medium uk-child-width-1-1 uk-blog-list" uk-height-match="target:.uk-same-height"
                        uk-grid>
                        <!--  -->
                        @foreach($related as $value)
                            @if($value->uri != $data->uri)
                            @if($value->external_link)
                                <li>
                                    <div class=" bg-white uk-box-shadow-medium uk-article-list">
                                        <div class="open-video" data-youtube-id="{{$value->external_link}}">
                                            <div class="uk-media-250 uk-position-relative uk-same-height">
                                                <div class="uk-overlay-primary uk-position-cover"></div>
                                                <div class="uk-position-center-top">
                                                    <div
                                                        class="uk-article-category bg-primary">{{show_category($value->post_category)}}</div>
                                                </div>
                                                <img
                                                    src="https://img.youtube.com/vi/{{$value->external_link}}/maxresdefault.jpg">
                                                <div class="uk-position-center uk-zindex">
                                                    <i class="fa fa-play fa-2x text-white"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- if video -->
                                        <div class=" uk-padding uk-same-height">
                                            <h1 class="f-20 f-w-400 uk-margin-remove"><a
                                                    href="{{url(geturl($value['uri'],$value['page_key']))}}">
                                                    {{$value->post_title}}
                                                </a></h1>
                                        </div>
                                    </div>
                                </li>
                            @else
                                <li>
                                    <div class="bg-white uk-box-shadow-medium uk-article-list">
                                        <div class="uk-media-250 uk-position-relative">
                                            <a href="{{url(geturl($value['uri'],$value['page_key']))}}">
                                                <div class="uk-overlay-primary uk-position-cover"></div>
                                                <div class="uk-position-center-top">
                                                    <div
                                                        class="uk-article-category bg-primary">{{show_category($value->post_category)}}</div>
                                                </div>
                                                <img src="{{asset('uploads/original/' . $value->page_thumbnail)}}">
                                            </a>
                                        </div>
                                        <div class="uk-position-relative  uk-padding uk-same-height">
                                            <h1 class="f-20 f-w-400 uk-margin-remove"><a
                                                    href="{{url(geturl($value['uri'],$value['page_key']))}}">
                                                    {{$value->post_title}}
                                                </a></h1>
                                        </div>
                                    </div>
                                </li>
                        @endif
                            @endif

                    @endforeach
                    <!--  -->
                        <!--  -->
                        <!--  -->
                    </ul>
                    <!--  -->
                </div>
            </div>
        </div>
    </section>
    <!-- section end -->
@stop
