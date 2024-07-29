@extends('themes.default.common.master')
@section('post_title',$data->post_title)
@section('meta_keyword',$data->meta_keyword)
@section('meta_description',$data->meta_description)
@section('content')
    <!--section-->
    <!-- banner -->
    <section class="uk-cover-container  uk-position-relative bg-primary">
        <div class="uk-width-1-1 uk-position-z-index">
            <div class="uk-container uk-position-relative text-white uk-flex-middle uk-flex"
                 uk-height-viewport="expand: true; min-height: 150;">
                <div class="uk-width-1-1">
                    <div class="uk-grid uk-flex-middle" uk-grid
                         uk-scrollspy="cls: uk-animation-slide-top-small; target:div, h1, p, a;  delay: 100; repeat: false;">
                        <div class="uk-width-1-2@l uk-width-1-1">
                            <h1 class="f-30 f-w-600 text-white uk-margin-small">{{$data->post_title}}</h1>
                        </div>
                        <div class="uk-width-1-2@l uk-width-1-1 uk-text-right@l">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end banner -->


    <!-- section -->
    <section class="uk-section bg-white">
        <div class="uk-container">
            <!--  -->
            <div class="uk-grid uk-flex-middle" uk-grid
                 uk-scrollspy="cls: uk-animation-slide-top-small; target:div, h1, h2, h3,  p, a;  delay: 100; repeat: false;">
                <div class="uk-width-expand@m uk-match-height">
                    {!! $data->post_content !!}
                </div>
                <div class="uk-width-1-3@m ">
                    <div class="uk-border-rounded">
                        <img src="{{asset('uploads/original/' . $data->page_thumbnail)}}">
                    </div>
                </div>
            </div>
            <!--  -->
        </div>
    </section>
    <!-- section -->

@stop
