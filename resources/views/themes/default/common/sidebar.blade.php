<div class="uk-width-1-4@m uk-flex-first uk-flex-last@l uk-flex-last@m">
    <div class="uk-section">
        <div style="z-index: 9;" uk-sticky="media: @m; offset: 150; bottom: #uk-stop-sticky;">
            <div class="bg-white">
                <h1 class="uk-h4 uk-margin">Services</h1>
                <ul class="uk-aside-list">
                    @foreach($related as $value)
                        <li><a href="{{url(geturl($value['uri'],$value['page_key']))}}" class="uk-active">{{$value->post_title}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
