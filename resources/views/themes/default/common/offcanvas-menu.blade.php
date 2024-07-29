<!-- start offcanvas menu -->
<div id="offcanvas-reveal" uk-offcanvas="flip: true;  overlay: true;">
    <div
        class="uk-offcanvas-bar uk-dark uk-offcanvas-bar-white uk-padding-remove  uk-box-shadow-medium uk-flex uk-flex-between uk-flex-column">
        <div class=" uk-padding-small uk-border-bottom">
            <div class="uk-flex uk-flex-between uk-flex-middle uk-flex text-black">
                <div>
                    {{$setting->site_name}}
                </div>
                <div>
                    <button class="uk-offcanvas-close uk-close-large text-red" type="button" uk-close></button>
                </div>
            </div>
        </div>
        <div>

            <nav>
                <ul class="uk-navsidebar    uk-nav-parent-icon uk-nav-left  " uk-nav="multiple: false">
                    <li><a href="{{url('/')}}">Home</a></li>
                    @if ($navigations->count() > 0)
                        @foreach ($navigations as $row)
                            @if($row->id==40)
                                <li class="uk-parent uk-open">
                                    <a href="{{ url('page/' . posttype_url($row->uri)) }}">{{$row->post_type}}</a>
                                    <ul class="uknavsub">
                                        @foreach(getposts($row->id) as $value)
                                            <li>
                                                <a href="{{url(geturl($value['uri'], $value['page_key']))}}">{{$value->post_title}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li>
                                    <a href="{{ url('page/' . posttype_url($row->uri)) }}">{{$row->post_type}}                                    </a>
                                </li>
                            @endif

                        @endforeach
                    @endif
                </ul>
            </nav>
        </div>
        <!-- social icon -->
        <div class="uk-position-relative">
            <div>
                <div class="uk-padding-small uk-border-top">
                    <ul class="uk-grid-small  uk-flex-center" uk-grid>
                        <li><a class="facebookBtn smGlobalBtn" href="{{$setting->facebook_link}}"></a></li>
                        {{--                        <li><a class="instagramBtn smGlobalBtn" href="#"></a></li>--}}
                        <li><a class="twitterBtn smGlobalBtn" href="{{$setting->twitter_link}}"></a></li>
                        {{--                        <li><a class="youtubeBtn smGlobalBtn" href="#"></a></li>--}}
                        {{--                        <li><a class="linkedinBtn smGlobalBtn" href="#"></a></li>--}}
                    </ul>
                </div>
                <div class="uk-padding-small uk-border-top">
                    <div class="f-15 uk-margin-remove uk-text-left@s uk-text-center text-black">Contact at</div>
                    <div class="f-20 uk-margin-remove uk-text-left@s uk-text-center text-primary">
                        {{$setting->phone}}
                    </div>
                </div>
            </div>
        </div>
        <!-- end social icon -->
    </div>
</div>
<!-- end offcanvas menu -->
