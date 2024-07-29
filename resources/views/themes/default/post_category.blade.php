@extends('themes.default.common.master')

@section('content')
    <section class="page-title page-title-layout5 bg-primary">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="pagetitle__heading text-white">News & Media</h1>

                </div><!-- /.col-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.page-title -->

    <!-- ======================
      Blog Grid
    ========================= -->
    <section class="blog-grid">
        <div class="container">
            <div class="row">
                <!-- Post Item #1 -->
                   @if($posts->count()>0)
                @foreach($posts as $value)
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="post-item">
                            <div class="post__img">
                                  <a href="{{url(geturl($value['uri'], $value['page_key']))}}">
                                    @if($value->page_thumbnail)
                                <img src="{{asset('uploads/medium/' . $value->page_thumbnail)}}" alt="img"loading="lazy">
                                @else
                                 <img src="{{asset('images/default.png')}}" alt="img"loading="lazy">
                                 @endif
                                </a>
                            </div><!-- /.post__img -->
                            <div class="post__body">
                                <div class="post__meta-cat">
                                     @if($value->post_category)
                            <a href="{{route('category.navigation',loop_category($value->post_category)->uri)}}">{{loop_category($value->post_category)->category}}</a>
                            @else
                            <a href="{{ url('page/' . posttype_url($data->uri)) }}">News & Media</a>
                            @endif
                                </div><!-- /.blog-meta-cat -->
                                <div class="post__meta d-flex">
                                 <span class="post__meta-date">{{$value->created_at->format('M')}} {{$value->created_at->format('d')}}, {{$value->created_at->format('Y')}}</span>
                                </div>
                                  <h4 class="post__title"><a href="{{url(geturl($value['uri'], $value['page_key']))}}">
                            {{$value->post_title}} </a></h4>
                                <a href="{{url(geturl($value['uri'], $value['page_key']))}}" class="btn btn__secondary btn__link btn__rounded"><span>Read More</span>
                                <i class="icon-arrow-right"></i>
                            </a>
                            </div><!-- /.post__body -->
                        </div><!-- /.post-item -->
                    </div><!-- /.col-lg-4 -->
                @endforeach
                @endif
            </div><!-- /.row -->
            <div class="row">
                <div class="col-12 text-center">
                    <nav class="pagination-area">
                        <ul class="pagination justify-content-center">
                            {{$posts->links()}}

                        </ul>
                    </nav><!-- .pagination-area -->
                </div><!-- /.col-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.blog Grid -->
@stop
