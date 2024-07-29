@extends('themes.default.common.master')
@section('content')
    <!-- start banner -->
    <section class="uk-position-relative">
        <div class="bg-primary uk-position-relative uk-visible-toggle home-page-slider" tabindex="-1"
             uk-slider="autoplay: true; autoplay-interval: 50000; pause-on-hover: true; clsActivated: uk-transition-active;  ">

            <ul class="uk-slider-items uk-child-width-1-1 uk-flex-middle">
                @if($banner->count()>0)
                    @foreach($banner as $value)
                        <li>
                            <div class="uk-overlay-primary  uk-position-cover "></div>
                            <div class="uk-media-550">
                                <img src="{{asset('uploads/banners/'.$value->picture)}}" alt="home banner">
                            </div>
                            <div class="uk-position-center" style="width: 100%;">
                                <div class="uk-container uk-container-large">
                                    <ul class="uk-grid-medium uk-margin-large-top uk-flex-middle" uk-grid>
                                        <li class="uk-width-1-2@s">
                                            <div class="uk-transition-slide-right">
                                                <h1 class="uk-h1 text-white uk-text-bold uk-position-relative uk-margin-small">
                                                    {{$value->title}} </h1>
                                                <div class="text-white uk-display-block uk-margin">
                                                    {{$value->caption}}

                                                </div>
                                                <a href="{{$value->link}}"
                                                   class="uk-button uk-button-large uk-button-white-outline">
                                                    {{$value->link_title}}
                                                </a>
                                            </div>
                                        </li>
                                        @if($value->banner_content)
                                            <li class="uk-width-1-2@s uk-text-right">
                                                <div class="uk-transition-slide-right">
                                                    <div class="open-video"
                                                         data-youtube-id="{{$value->banner_content}}">
                                                        <div class="play-btn uk-align-center">
                                                            <i class="fa fa-play-circle" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif

            </ul>
            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous
               uk-slider-item="previous"></a>
            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next
               uk-slider-item="next"></a>
        </div>
    </section>
    <!-- end banner -->

    <!-- section start -->
    <section class="uk-section">
        <div class="line_wrap">
            <div class="line_item"></div>
            <div class="line_item"></div>
            <div class="line_item"></div>
            <div class="line_item"></div>
            <div class="line_item"></div>
        </div>
        <div class="uk-container uk-container-large">
            <div class="uk-grid-medium uk-flex-middle" uk-grid
                 uk-scrollspy="cls: uk-animation-slide-top-small; target:h1, a, p;  delay: 100; repeat: false;">
                <div class="uk-width-expand@m">
                    <h1 class="uk-h2 uk-text-bold">{{$about->post_type}}</h1>
                    <div class="f-18 uk-margin-bottom">
                        {!! $about->content !!}
                    </div>
                </div>
                <div class="uk-width-1-2@m">
                    <div class="">
                        <div class="uk-border-rounded uk-position-relative uk-text-center">
                            <a href="{{ url('page/' . posttype_url($about->uri)) }}">
                                <img src="images/about/featured.svg" uk-img>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
    <!-- section start -->
    <section class="uk-section bg-light">
        <div class="uk-container uk-container-large">
            <!--  -->
            <div class="uk-pull-top uk-home-logo-sec uk-box-shadow-medium uk-border-rounded">
                <div class="uk-grid-large uk-flex-middle" uk-grid
                     uk-scrollspy="cls: uk-animation-slide-top-small; target:h1, li;  delay: 100; repeat: false;">
                    <div class="uk-width-1-6@m">
                        <h1 class="uk-h3 text-white">Clients that<br> Trust Us</h1>
                    </div>
                    <div class="uk-width-expand@m">
                        <div class="uk-position-relative uk-visible-toggle " tabindex="-1"
                             uk-slider="finite: true; autoplay: true;">
                            <ul class="uk-slider-items uk-child-width-1-1 uk-child-width-1-4@s uk-child-width-1-5@m uk-grid-small"
                                uk-grid>
                                @foreach($logos->take(5) as $value)
                                    <li>
                                        <a href="" target="_blank"
                                           uk-tooltip="Lorem Ipsum is simply dummy text of the printing">
                                            <div class="uk-logo-list uk-border-rounded">
                                                <img src="{{asset('uploads/original/'.$value->thumbnail)}}" class="uk-img">
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->
        </div>
    </section>
    <!-- end section -->
    <!-- section start -->
    <section class="uk-section bg-light uk-padding-remove-top  uk-position-relative">
        <div class="uk-container uk-container-large"
             uk-scrollspy="cls: uk-animation-slide-top-small; target:h1, a;  delay: 100; repeat: false;">
            <h1 class="uk-h2 uk-text-bold">We Promise</h1>
            <ul class="uk-grid-medium uk-child-width-1-3@l" uk-height-match=".uk-height-match" uk-grid
                uk-scrollspy="cls: uk-animation-slide-top-small; target:h3, img, a, p;  delay: 100; repeat: false;">
                @foreach($promises as $value)
                <li>
                    <div
                        class="bg-white uk-box-shadow-medium uk-padding uk-border-rounded uk-text-center uk-height-match">
                        <div>
                            <img src="{{asset('uploads/medium/'.$value->thumbnail)}}" width="100">
                        </div>
                        <h3 class="uk-h4 uk-margin-small uk-text-bold">{{$value->title}}</h3>
                       {!! $value->brief !!}
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </section>
    <!-- end section -->
@stop
