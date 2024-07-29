<!-- footer start -->
<div class="uk-section-secondary uk-section footer-section" uk-height-viewport="expand: true;"
     uk-scrollspy="cls: uk-animation-slide-top-small; target:h1, a, li, span, .uk-panel, img;  delay: 50; repeat: false;">
    <div class="uk-container uk-container-large">
        <div class="uk-grid-expand uk-child-width-1-1 uk-margin-bottom uk-grid " uk-grid="">
            <div class="uk-width-1-1@m uk-first-column">
                <div class="uk-margin uk-text-left@m uk-text-center">
                    <a class="uk-link" href="{{url('/')}}">
                        <img class="uk-image" alt="" uk-img="" src="{{asset('images/logo-white.svg')}}" width="70"></a>
                </div>
            </div>
        </div>
        <div class="uk-grid-expand uk-grid-margin uk-grid uk-flex-middle" uk-grid="">
            <div class="uk-width-auto@m uk-first-column">
                <div class="uk-text-center@s uk-text-center">
                    <ul class="uk-margin-remove-bottom uk-subnav  uk-subnav-divider uk-flex-center@s uk-flex-center"
                        uk-margin="">
                        <li class="uk-item uk-first-column">
                            <span><a class="uk-link" href="tel:{{$setting->phone}}"
                                     target="_blank">{{$setting->phone}}</a></span>
                        </li>
                        <li class="uk-item">
                            <span><a class="uk-link" href="mailto:{{$setting->email_primary}}"
                                     target="_blank">{{$setting->email_primary}}</a></span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="uk-width-expand@m">
                <ul class="uk-margin-remove-bottom uk-subnav  uk-subnav-divider uk-flex-center" uk-margin="">
                    <li><a href="{{url('/')}}">Home</a></li>
                    @foreach ($navigations as $row)
                    <li><a href="{{ url('page/' . posttype_url($row->uri)) }}">{{$row->post_type}}</a></li>
                    @endforeach

                </ul>
            </div>
            <div class="uk-width-auto@m">
                <span
                    class="uk-panel uk-text-primary uk-margin uk-text-right@m uk-text-center">Tell your friends!</span>
                <!-- social media icon -->
                <div id="social" class="uk-text-right@m uk-text-center uk-margin-large-left">
                    <a class="facebookBtn smGlobalBtn" href="{{$setting->facebook_link}}"></a>
                    <a class="twitterBtn smGlobalBtn" href="{{$setting->twitter_link}}"></a>
                    <!-- <a class="instagramBtn smGlobalBtn" href="#"></a>
                    <a class="youtubeBtn smGlobalBtn" href="#"></a>
                    <a class="linkedinBtn smGlobalBtn" href="#"></a> -->
                </div>
                <!-- END social media icon -->
            </div>
        </div>
        <div class="uk-grid-expand uk-child-width-1-1 uk-margin uk-grid uk-grid-stack" uk-grid="">
            <div class="uk-first-column">
                <div class="uk-panel uk-text-small uk-margin-remove-vertical uk-text-left@m uk-text-center">
                    {{$setting->copyright_text}}
                    <br> Design and Development by <a class="uk-link-muted"
                                                      href="https://cyberlink.com.np/">Cyberlink
                        Pvt. Ltd.</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer end -->
<!-- video modal -->
<div id="video-modal" class="uk-flex-top">
    <button class="uk-modal-close uk-icon uk-close uk-position-top-right text-white uk-padding" type="button"
            uk-icon="icon: close; ratio: 2"></button>
    <div class="uk-modal-dialog uk-margin-auto-vertical">
    </div>
</div>
<!-- end video modal-->


<!-- required javascript  -->
<a href="#" id="BackToTop" uk-scroll="" uk-totop class="show">
</a>
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
<script type='text/javascript'
        src='https://platform-api.sharethis.com/js/sharethis.js#property=6098c944a99fbf00117440b0&product=sop'
        async='async'></script>
</body>
</html>
