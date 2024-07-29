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
                uk-height-viewport="expand: true; min-height: 500;">
                <div class="uk-width-1-2@m uk-text-left">
                    <div class="uk-light">
                        <ul class="uk-breadcrumb">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><span>{{ $data->post_type }}</span></li>
                        </ul>
                    </div>
                    <h1 class="uk-h1 uk-text-bold text-white uk-margin-small">Apply Now</h1>
                    <p class="uk-text-lead text-white">Join Our Dynamic Team and Make a Difference!</p>
                </div>
            </div>
        </div>
    </section>
    <!-- section start -->
    <section class="uk-section ">

        <div class="uk-container uk-container-large"
            uk-scrollspy="cls: uk-animation-slide-top-small; target:h1, li,p,a;  delay: 100; repeat: false;">
            <div class=" uk-grid">
                <div class="uk-width-3-4@m">
                    <div class="uk-card uk-card-default career-list">
                        <h1 class="uk-h4">Basic Job Information</h1>
                        <table class="uk-table  uk-table-responsive ">
                            <tbody>
                                <tr>
                                    <td class="uk-text-bold">Job Category</td>
                                    <td>{{ $data->job_category }}</td>
                                </tr>
                                <tr>
                                    <td class="uk-text-bold">Employment Type</td>
                                    <td>{{ $data->employment_type }}</td>
                                </tr>
                                <tr>
                                    <td class="uk-text-bold">No. of Vacancy/s</td>
                                    <td>{{ $data->no_of_vacancy }}</td>
                                </tr>
                                <tr>
                                    <td class="uk-text-bold">Apply Before(Deadline)</td>
                                    <td>{{ $data->deadline }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="uk-card uk-card-default career-list uk-margin-top">
                        <h1 class="uk-h4 uk-margin-remove">About the job</h1>
                        <hr>
                        <h1 class="uk-h5 uk-margin-small-top">Role Description</h1>
                        <p class="uk-small-font uk-text-justify">{!! $data->post_excerpt !!}</p>
                        <h1 class="uk-h5">Qualifications</h1>
                        {!! $data->post_content !!}
                        <a href="{{ route('applicant.applyform') }}" class="uk-button uk-button-primary">Apply Now</a>
                    </div>
                </div>
                <div class="uk-width-1-4@m">
                    <div class="uk-clearfix" style="z-index: 1;"
                        uk-sticky="media: 640; offset: 200; bottom: #uk-stop-sticky">
                        <div class="uk-card uk-card-default career-list uk-margin-top uk-margin-remove@m">
                            <p class="uk-text-bold"> Search, Apply & Get Job</p>
                            <a href="{{ route('applicant.login') }}" class="uk-button uk-button-primary  uk-width-1-1">Log
                                In</a><br>
                            <a href="{{ route('applicant.register') }}"
                                class="uk-button uk-button-secondary uk-margin-top uk-width-1-1">Register</a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="uk-stop-sticky" class="uk-clearfix"></div>
    </section>
@endsection
