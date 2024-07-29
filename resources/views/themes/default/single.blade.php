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
                            <li><a href="{{ url('page/' . posttype_url($service->uri)) }}">{{$service->post_type}}</a></li>
                            <li><span>{{$data->post_title}}</span></li>
                        </ul>
                    </div>
                    <h1 class="uk-h1 uk-text-bold text-white uk-margin-small">{{$data->post_title}}</h1>
                    <p class="uk-text-lead text-white">{{$data->sub_title}}</p>
                </div>
            </div>
        </div>
    </section>
    <!-- end header -->
    <!-- section -->
    <section class="bg-white">
        <div class="uk-container uk-container-large">
            <div uk-grid class="uk-grid-divider"
                 uk-scrollspy="cls: uk-animation-slide-top-small; target:a, li, h1, h2, h3, h4, h5, h6, p;  delay: 50; repeat: false;">
                <div class="uk-width-expand@m">
                    <div class="uk-section">
                        {!! $data->post_content !!}
                        <div id="uk-stop-sticky"></div>
                    </div>
                </div>
                @include('themes.default.common.sidebar')
            </div>
        </div>
    </section>
    <!-- section -->
@stop
