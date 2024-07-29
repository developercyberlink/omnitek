@extends('themes.default.common.master')
@section('content')
    <!-- header -->
    <section
        class="uk-cover-container  uk-position-relative uk-flex uk-flex-middle uk-background-norepeat uk-background-cover"
        style="background:url(images/about/title-banner.jpg);">
        <div class="uk-overlay-primary  uk-position-cover "></div>
        <div class="uk-home-banner uk-width-1-1 uk-position-z-index"
            uk-scrollspy="cls: uk-animation-slide-top-small; target:a, li, h1, p;  delay: 100; repeat: false;">
            <div class="uk-container uk-container-large uk-position-relative text-white uk-flex-middle uk-flex"
                uk-height-viewport="expand: true; min-height: 200;">
                <div class="uk-width-1-2@m uk-text-left">
                    <div class="uk-light">
                        <ul class="uk-breadcrumb">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><span>Application Form</span></li>
                        </ul>
                    </div>
                    <h1 class="uk-h1 uk-text-bold text-white uk-margin-small">Apply Now</h1>

                </div>
            </div>
        </div>
    </section>
    <!-- section start -->
    <section class="uk-section uk-padding-remove-top">
        <div class="line_wrap">
            <div class="line_item"></div>
            <div class="line_item"></div>
            <div class="line_item"></div>
            <div class="line_item"></div>
            <div class="line_item"></div>
        </div>
        <div class="uk-container uk-container-large"
            uk-scrollspy="cls: uk-animation-slide-top-small; target:h1, li,p;  delay: 100; repeat: false;">
            <div class="uk-container uk-container-large uk-margin-large-top"
                uk-scrollspy="cls: uk-animation-slide-top-small; target:h1, div,a;  delay: 100; repeat: false;">
                <div class="uk-card uk-card-default uk-padding">
                    <form class="uk-padding@m uk-padding-remove uk-padding-remove-top" method="post"
                        action="{{ route('career') }}" enctype="multipart/form-data">
                        @csrf

                        <h1 class="uk-h3 uk-text-bold uk-scrollspy-inview uk-animation-slide-top-small">APPLY NOW</h1>
                        <em class="uk-h5  uk-text-bold text-primary ">*Please fill in the required information</em>
                        <hr>
                        <div class=" uk-child-width-1-2@m uk-grid">
                            <div class="uk-margin-top">
                                <label class="uk-form-label uk-text-bold" for="firstname">First Name</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="firstname" name="first_name" type="text">
                                </div>
                                @if ($errors->has('first_name'))
                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                            <div class="uk-margin-top">
                                <label class="uk-form-label uk-text-bold" for="lastname">Last Name</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="lastname" name="last_name" type="text">
                                </div>
                                @if ($errors->has('last_name'))
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                            <div class="uk-margin-top">
                                <label class="uk-form-label uk-text-bold" for="email">Email</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="email" name="email" type="email">
                                </div>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="uk-margin-top">
                                <label class="uk-form-label uk-text-bold" for="contact">Contact</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="contact" name="contact" type="number">
                                </div>
                                @if ($errors->has('contact'))
                                    <span class="text-danger">{{ $errors->first('contact') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="uk-margin">
                            <div>
                                <div uk-form-custom="target: true">
                                    <input type="file" name="file" aria-label="Custom controls">
                                    <input class="uk-input uk-form-width-small uk-upload uk-margin-right " type="text"
                                        placeholder="UPLOAD CV " aria-label="Custom controls" disabled>
                                    <span>Upload your CV(doc,docx,pdf) </span>
                                </div>
                                @if ($errors->has('file'))
                                    <span class="text-danger">{{ $errors->first('file') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="uk-margin-top uk-flex">
                            <input type="checkbox" name="agree" id="agree">
                            <label for="agree" class="uk-margin-small-top uk-margin-small-left"> I agree to the Omnitek’s
                                Terms and conditions and Privacy policy.</label>
                            @if ($errors->has('agree'))
                                <span class="text-danger">{{ $errors->first('agree') }}</span>
                            @endif
                        </div>

                        <button type="submit" class="uk-button uk-button-secondary uk-margin-top">Submit Now</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
