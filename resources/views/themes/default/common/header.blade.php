<!DOCTYPE html>
<html>

<head>
    <title>{{ $setting->site_name }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!-- favicon -->
    <link href="{{ asset('images/favicon.ico') }}" rel="icon" />
    <meta name="theme-color" content="#3e1f9e">
    <!-- end favicon -->
    <!-- required css  -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <!-- end -->
</head>

<body>
    <header id="header">
        <!-- mobile menu -->
        @include('themes.default.common.offcanvas-menu')
        <!-- end mobile menu -->
        <!-- start main menu -->
        <div class="uk-h-sticky uk-border-top"
            uk-sticky="top: 200; animation:uk-animation-fade uk-animation-slow uk-transform-origin-bottom-center">
            <div class="uk-middle-header uk-flex-middle">
                <div class="uk-container uk-container-large">
                    <nav class="uk-navbar">
                        <div class="uk-navbar-left">
                            <a class="uk-logo text-primary uk-text-bold uk-h1 uk-margin-remove"
                                href="{{ url('/') }}">
                                <img alt="" src="{{ asset('images/logo.png') }}" width="160">
                            </a>
                        </div>
                        <div class="uk-navbar-right">
                            <div class="uk-navigation uk-visible@m">
                                <!-- menu -->
                                <nav class="" uk-navbar>
                                    <ul class="uk-navbar-nav   uk-position-relative">
                                        <li><a href="{{ url('/') }}">Home</a></li>
                                        @if ($navigations->count() > 0)
                                            @foreach ($navigations as $row)
                                                @if ($row->id == 40)
                                                    <li>
                                                        <a href="{{ url('page/' . posttype_url($row->uri)) }}">{{ $row->post_type }}
                                                            <span class=""
                                                                uk-icon="icon: chevron-down; ratio: 1;"></span></a>
                                                        <div class="uk-navbar-dropdown">
                                                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                                                @foreach (getposts($row->id) as $value)
                                                                    <li>
                                                                        <a
                                                                            href="{{ url(geturl($value['uri'], $value['page_key'])) }}">{{ $value->post_title }}</a>
                                                                    </li>
                                                                @endforeach

                                                            </ul>
                                                        </div>
                                                    @else
                                                    <li>
                                                        <a href="{{ url('page/' . posttype_url($row->uri)) }}">{{ $row->post_type }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                            <li>
                                                
                                                @if(Auth::guard('applicant')->check())
                                                    <!-- <a href="{{ route('applicant.logout') }}">Logout</a> -->
                                                @else
                                                    <a href="{{ route('applicant.login') }}">Login</a>
                                                @endif
                                            </li>
                                            <li>
                                                <a href="{{ route('applicant.register') }}">Register </a>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                                <!-- menu -->
                            </div>
                            <!-- social media icon -->
                            <div id="social" class="uk-text-right@m uk-text-center uk-margin-large-left">
                                @if(Auth::guard('applicant')->check())
                                    <div class="uk-inline">
                                        <a class="uk-button uk-button-default" href="#">Hi {{ Auth::guard('applicant')->user()->first_name }} {{ Auth::guard('applicant')->user()->last_name }}</a>
                                        <div uk-dropdown="pos: bottom-left" class="uk-width-auto">
                                            <ul class="uk-nav uk-dropdown-nav">
                                                <li><a href="{{ route('applicant.logout') }}">Logout</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                @else
                                    <!-- <div class="uk-inline">
                                        <span class="uk-text-default uk-text-emphasis" style="cursor: default;">Welcome</span>
                                    </div> -->

                                @endif

                                <!-- <a class="facebookBtn smGlobalBtn" href="{{ $setting->facebook_link }}"></a>
                                <a class="twitterBtn smGlobalBtn" href="{{ $setting->twitter_link }}"></a> -->
                                <!-- <a class="instagramBtn smGlobalBtn" href="#"></a>
                            <a class="youtubeBtn smGlobalBtn" href="#"></a>
                            <a class="linkedinBtn smGlobalBtn" href="#"></a> -->
                            </div>
                            <!-- END social media icon -->
                            <!-- mobile menu button -->
                            <button class="uk-navbar-toggle uk-hidden@m  " uk-toggle="target: #offcanvas-reveal"
                                uk-navbar-toggle-icon></button>
                            <!-- mobile menu button -->
                        </div>
                    </nav>
                </div>
                <div class="uk-clearfix"></div>
            </div>
        </div>
        <!-- end main menu -->

    </header>
    <!-- /header -->
