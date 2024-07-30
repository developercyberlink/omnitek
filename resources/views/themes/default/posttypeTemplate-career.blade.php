@extends('themes.default.common.master')
@section('post_title', $data->post_title)
@section('meta_keyword', $data->meta_keyword)
@section('meta_description', $data->meta_description)
@section('content')
    <!-- header -->
    @if(session('applicant_message'))
        <div uk-alert>
            {{ session('applicant_message') }}

            <a href class="uk-alert-close" uk-close></a>
        </div>
    @endif
    <section
        class="uk-cover-container  uk-position-relative uk-flex uk-flex-middle uk-background-norepeat uk-background-cover"
        style="background:url({{ asset('uploads/medium/' . $data->banner) }});">
        <div class="uk-overlay-primary  uk-position-cover "></div>
        <div class="uk-home-banner uk-width-1-1 uk-position-z-index"
            uk-scrollspy="cls: uk-animation-slide-top-small; target:a, li, h1, p;  delay: 100; repeat: false;">
            <div class="uk-container uk-container-large uk-position-relative text-white uk-flex-middle uk-flex"
                uk-height-viewport="expand: true; min-height: 500;">
                <div class="uk-width-1-2@m uk-text-left">
                    <div class="uk-light">
                        <ul class="uk-breadcrumb">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><span>{{ $data->post_type }}</span></li>
                        </ul>
                    </div>
                    <h1 class="uk-h1 uk-text-bold text-white uk-margin-small">{{ $data->post_type }}</h1>
                    <p class="uk-text-lead text-white">{{ $data->caption }}</p>
                </div>
            </div>
        </div>
    </section>
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
            <div uk-scrollspy="cls: uk-animation-slide-top-small; target:h1, a, p,th,td;  delay: 100; repeat: false;">

                <h1 class="uk-h2 uk-text-bold">AVAILABLE POSITIONS</h1>
                <div class="f-18 ">
                    {!! $data->content !!}
                </div>
                @if ($posts->count() > 0)
                    @foreach ($posts as $row)
                        <div class="uk-card uk-card-default career-list uk-margin-top">
                            <div>
                                <p class="uk-text-bold uk-margin-remove">{{ $row->post_title }}</p>
                                <p class="uk-margin-remove carerer-skills">{{ $row->sub_title }}</p>

                                @if (Auth::guard('applicant')->check())
                                    @php
                                        $user = Auth::guard('applicant')->user();
                                    @endphp

                                    @if ($user->status == 1)
                                        <a href="{{ url(geturl($row['uri'], $row['page_key'])) }}">Apply Now >></a>
                                    @else
                                        <p>Please verify your account with the email sent to your email address.</p>
                                    @endif
                                @else
                                <a href="{{ route('applicant.login') }}" style="font-weight:bold;">Know More >></a>

                                @endif

                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>
@endsection
