@extends('themes.default.common.master')
@section('post_title',$data->post_title)
@section('meta_keyword',$data->meta_keyword)
@section('meta_description',$data->meta_description)
@section('content')
    <!-- header -->
    <section
        class="uk-cover-container  uk-position-relative uk-flex uk-flex-middle uk-background-norepeat uk-background-cover"
        style="background:url({{asset('uploads/original/' . $data->banner)}});">
        <div class="uk-overlay-primary  uk-position-cover "></div>
        <div class="uk-home-banner uk-width-1-1 uk-position-z-index"
             uk-scrollspy="cls: uk-animation-slide-top-small; target:a, li, h1, p;  delay: 100; repeat: false;">
            <div class="uk-container uk-container-large uk-position-relative text-white uk-flex-middle uk-flex"
                 uk-height-viewport="expand: true; min-height: 500;">
                <div class="uk-width-1-2@m uk-text-left">
                    <div class="uk-light">
                        <ul class="uk-breadcrumb">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><span>{{$data->post_type}}</span></li>
                        </ul>
                    </div>
                    <h1 class="uk-h1 uk-text-bold text-white uk-margin-small">{{$data->post_type}}</h1>
                    <p class="uk-text-lead text-white">
                        {{$data->caption}}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- end header -->
    <!-- section -->
    <section class="uk-section-large bg-white">
        <div class="uk-container uk-container-large">
            <!--  -->
            <ul class="uk-child-width-1-1@s uk-child-width-1-2@m  uk-child-width-1-2@l uk-grid-medium"
                uk-grid="masonry: true"
                uk-scrollspy="cls: uk-animation-slide-top-small; target:.uk-service-list;  delay: 100; repeat: false;">

                @if($posts->count()>0)
                    @foreach($posts as $row)
                        <li>
                            <div class="uk-service-list">
                                <div class="uk-service-list-box">
                                    <div class="image"><span
                                            style="background-image: url('{{asset('uploads/original/' . $row->page_thumbnail)}}');"></span></div>
                                    <div class="uk-h2 uk-text-bold h3">{{$row->post_title}}</div>
                                    <div class="text">
                                        <h3 class="uk-h2 text-white uk-text-bold">{{$row->post_title}}</h3>
                                        <div class="hidden-text">
                                           {!! $row->post_excerpt !!}
                                            <a href="{{url(geturl($row['uri'],$row['page_key']))}}"
                                               class="uk-button uk-button-large uk-button-white-outline">Learn More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif

            </ul>
            <!--  -->
        </div>
    </section>
    <!-- section -->
@endsection
