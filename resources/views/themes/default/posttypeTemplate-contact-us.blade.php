@extends('themes.default.common.master')
@section('post_title', $data->post_title)
@section('meta_keyword', $data->meta_keyword)
@section('meta_description', $data->meta_description)
@section('content')
    <!-- header -->
    <section
        class="uk-cover-container  uk-position-relative uk-flex uk-flex-middle uk-background-norepeat uk-background-cover"
        style="background:url({{ asset('uploads/original/' . $data->banner) }});">
        <div class="uk-overlay-primary  uk-position-cover "></div>
        <div class="uk-home-banner uk-width-1-1 uk-position-z-index"
            uk-scrollspy="cls: uk-animation-slide-top-small; target:a, li, h1, p;  delay: 100; repeat: false;">
            <div class="uk-container uk-container-large uk-position-relative text-white uk-flex-middle uk-flex"
                uk-height-viewport="expand: true; min-height: 400;">
                <div class="uk-width-1-2@m uk-text-left">
                    <div class="uk-light">
                        <ul class="uk-breadcrumb">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><span>{{ $data->post_type }}</span></li>
                        </ul>
                    </div>
                    <h1 class="uk-h1 uk-text-bold text-white uk-margin-small">{{ $data->post_type }}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- end header -->

    <!-- section -->
    <section class="uk-section bg-light">
        <div class="uk-container uk-container-large">
            <div class="uk-child-width-expand@s" uk-grid uk-height-match="target:.uk-same-height"
                uk-scrollspy="cls: uk-animation-slide-top-small; target:div, p, h1, a;  delay: 100; repeat: false;">
                <!--  -->
                <div>
                    <div class="uk-padding bg-white uk-border-rounded uk-box-shadow-large uk-same-height">
                        <h1 class="uk-h4 f-w-400 ">Location</h1>
                        <ul class="uk-list-varticle  text-primary ">
                            <li class="uk-flex uk-flex-middle"><i
                                    class="fa fa-map-marker fa-2x uk-margin-small-right text-primary"></i> <a
                                    href="https://www.google.com/maps/place/Menlo+Park,+CA,+USA/@37.4765208,-122.2251151,12z/data=!3m1!4b1!4m5!3m4!1s0x808fa6b1117280ff:0xebbf998e5df289ab!8m2!3d37.4529598!4d-122.1817252"
                                    target="_blank" class="text-black">{{ $setting->location1 }}</a></li>
                        </ul>
                        <div class="uk-contact-icon">
                            <i class="fa fa-map-marker fa-5x"></i>
                        </div>
                    </div>
                </div>
                <!--  -->

                <!--  -->
                <div>
                    <div class="uk-padding bg-white uk-border-rounded uk-box-shadow-large uk-same-height">
                        <h1 class="uk-h4 f-w-400 ">Contact at</h1>
                        <ul class="uk-list-varticle  text-primary ">
                            <li class="uk-flex uk-flex-middle"><i
                                    class="fa fa-phone fa-2x uk-margin-small-right  text-primary"></i> <a
                                    href="tel:{{ $setting->phone }}" class="text-black">{{ $setting->phone }}</a></li>
                        </ul>
                        <div class="uk-contact-icon">
                            <i class="fa fa-phone fa-5x"></i>
                        </div>
                    </div>
                </div>
                <!--  -->

                <!--  -->
                <div>
                    <div class="uk-padding bg-white uk-border-rounded uk-box-shadow-large uk-same-height">
                        <h1 class="uk-h4 f-w-400 ">Email us</h1>
                        <ul class="uk-list-varticle  text-primary ">
                            <li class="uk-flex uk-flex-middle"><i
                                    class="fa fa-envelope fa-2x uk-margin-small-right  text-primary"></i> <a
                                    href="mailto:{{ $setting->email_primary }}"
                                    class="text-black">{{ $setting->email_primary }}</a></li>
                        </ul>
                        <div class="uk-contact-icon">
                            <i class="fa fa-envelope fa-5x"></i>
                        </div>
                    </div>
                </div>
                <!--  -->

            </div>
            <div class="uk-margin-medium-top"
                uk-scrollspy="cls: uk-animation-slide-top-small; target:iframe, div;  delay: 100; repeat: false;">
                {!! $setting->google_map2 !!}
            </div>

        </div>
    </section>
    <!-- end section -->

@endsection
