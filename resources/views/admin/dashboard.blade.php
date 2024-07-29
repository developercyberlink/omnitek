@extends('admin.master')
@section('title','Dashboard')
@section('content')
<!-- Dashboard Tiles -->
<div class="row mb10">
          <div class="col-sm-6 col-md-3">
            <div class="panel bg-alert light of-h mb10">
              <div class="pn pl20 p5">
                <div class="icon-bg">
                  <i class="fa fa-file-o"></i>
                </div>
                <h2 class="mt15 lh15">
                  <b>{{$total_posts}}</b>
                </h2>
                <h5 class="text-muted">Total Posts</h5>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="panel bg-info light of-h mb10">
              <div class="pn pl20 p5">
                <div class="icon-bg">
                  <i class="fa fa-circle-o"></i>
                </div>
                <h2 class="mt15 lh15">
                  <b>{{$total_category}}</b>
                </h2>
                <h5 class="text-muted">Total Post Categories</h5>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="panel bg-danger light of-h mb10">
              <div class="pn pl20 p5">
                <div class="icon-bg">
                  <i class="fa fa-bar-envelope"></i>
                </div>
                <h2 class="mt15 lh15">
                  <b>{{$num_of_inquiries}}</b>
                </h2>
                <h5 class="text-muted">Number of Inquiries</h5>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="panel bg-warning light of-h mb10">
              <div class="pn pl20 p5">
                <div class="icon-bg">
                  <i class="fa fa-bar-chart-o"></i>
                </div>
                <h2 class="mt15 lh15">
                  <b>{{$post_visiters}}</b>
                </h2>
                <h5 class="text-muted">Post Visitors</h5>
              </div>
            </div>
          </div>
        </div>

        <!-- // -->
  <!-- Admin-panels -->
  <?php /*?>
  <div class="admin-panels" style="height:auto !important;">
<div class="row mb10">
        	 <!-- Chart Column -->
                    <!-- <div class="col-md-12 col-sm-12">
                    	    <h3 class="mt5 pb5 fw600">
                                              Visitors                        
                    	    	<small class="pull-right fw600">
                          <span class="text-primary">8,251 Unique Visitors</span>
                        </small>
                        </h3>                    
                      <div id="high-column2" style="width: 100%; height: 255px; margin: 0 auto"></div>
                    </div> -->
</div>



        
          <div class="row">

            <!-- Three Pane Widget -->
            <div class="col-md-12 admin-grid">

              <div class="panel sort-disable" id="p0">
                
                <div class="panel-body mnw700 of-a">
                  <div class="row">                   

                    <!-- Multi Text Column -->
<div class="col-md-6 br-r">

                      <h3 class="mt5 pb5 fw600">Most Viewed Pages</h3>
                      @if($max_viewed->count() > 0)
                       <ul class="list-group">
                       @foreach($max_viewed as $row)
                       	<li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{url(geturl($row->uri))}}" target="_blank"> {{$row->post_title}} </a>
                        {!! viewsIndicator($row->visiter) !!}                        
                      </li>
                      @endforeach            						  
						</ul>
            @endif
</div>

                    <!-- Flag/Icon Column -->
<div class="col-md-6">
                    	 <h3 class="mt5 pb5 fw600"> Recent Post </h3>
                       @if($recent_posts->count() > 0)
            <ul class="list-group">
            @foreach($recent_posts as $row)
                       	 <li class="list-group-item d-flex justify-content-between align-items-center">
						    <a href="{{url(geturl($row->uri))}}" target="_blank"> {{$row->post_title}} </a>						     
						  </li>
              @endforeach               
						  
						</ul>
            @endif
</div>


                  </div>
                </div>
              </div>
            </div>
            <!-- end: .col-md-12.admin-grid -->

          </div>
          <!-- end: .row -->
 

        </div>
        <!-- // -->
        <?php */?>
@endsection
