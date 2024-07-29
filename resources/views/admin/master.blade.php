<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> {{ config('app.name', '') }} - @yield('title') </title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="Cyberlink">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="<?= url('/') ?>" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>

    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600'>
  @yield('additional-css')
  <link rel="stylesheet" type="text/css" href="{{ asset(env('PUBLIC_PATH') . 'assets/skin/default_skin/css/theme.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset(env('PUBLIC_PATH') . 'assets/skin/default_skin/css/theme2.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset(env('PUBLIC_PATH') . 'assets/skin/default_skin/css/theme3.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset(env('PUBLIC_PATH') . 'assets/admin-tools/admin-forms/css/admin-forms.css') }}">
  <link rel="shortcut icon" href="{{ asset(env('PUBLIC_PATH') . 'images/favicon.png') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

    <![endif]-->
</head>
  <body class="dashboard-page sb-l-o sb-r-c">
  <!-- Start: Main -->
  <div id="main">

   <!-- Start: Header -->
    <header class="navbar navbar-fixed-top">
      <div class="navbar-branding">
        <a class="navbar-brand" href="{{ url('/') }}" target="_blank">
         Admin Panel
        </a>
        <span id="toggle_sidemenu_l" class="ad ad-lines"></span>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="avoid:javascript;" class="dropdown-toggle fw600 p15" data-toggle="dropdown"> <img src="{{ asset(env('PUBLIC_PATH') . 'assets/img/avatars/1.png') }}" alt="avatar" class="mw30 br64 mr15">

         {{ Auth::user()->name }}

            <span class="caret caret-tp hidden-xs"></span>
          </a>
          <ul class="dropdown-menu list-group dropdown-persist w250" role="menu">
          <li><a href="{{ route('admin.userprofile') }}">User Profile</a></li>
          <li><a href="{{ route('admin.changepassword') }}">Change Password </a></li>
                        @guest
                                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else

                    <li class="dropdown-footer">
                        <a class="animated animated-short fadeInUp" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                             <span class="fa fa-power-off pr5"></span>


                                                {{ __('Logout') }}
                                            </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                           {{ csrf_field() }}
                        </form>

                    </li>
            @endguest

          </ul>
        </li>
      </ul>
    </header>

    <!-- Start: Sidebar Left -->
    @include('admin.common.sidebar')

    <section id="content_wrapper">

      <!-- End: Topbar-Dropdown -->
      <!-- Start: Topbar -->
     {{-- @include('admin.common.breadcrumb') --}}
      <!-- End: Topbar -->
      <header id="topbar">
        <div class="topbar-left">
        </div>
<div class="topbar-right">
@yield('breadcrumb')
</div>
</header>
<!-- Begin: Content -->
<section id="content" class="animated fadeIn">
<!-- // -->

        <!-- Admin-panels -->
        @include('admin.common.message')
        @yield('content')
        <!-- <div class="admin-panels fade-onload">
          <div class="row">
         </div>
        </div>  -->

      <!-- Begin: Page Footer -->

       <!-- <footer id="content-footer">
        <div class="row">
          <div class="col-md-6">
            <span class="footer-legal">
              &copy; <?php
//echo date('Y');
?>
              Cyberlink Pvt. Ltd. </span>
          </div>
          <div class="col-md-6 text-right">
            <span class="footer-meta"></span>
            <a href="#content" class="footer-return-top">
              <span class="fa fa-arrow-up"></span>
            </a>
          </div>
        </div>
      </footer>  -->

      <!-- End: Page Footer -->
      </section>

    </section>
    <!-- End: Content-Wrapper -->

    <!-- Start: Right Sidebar -->
  </div>
  <!-- End: Main -->

  <!-- BEGIN: PAGE SCRIPTS -->

  <!-- jQuery -->
   <script src="{{ asset('vendor/jquery/jquery-1.11.1.min.js') }}"></script>
  <script src="{{ asset('vendor/jquery/jquery_ui/jquery-ui.min.js') }}"></script>

  <!-- HighCharts Plugin -->
  <script src="{{ asset('vendor/plugins/highcharts/highcharts.js') }}"></script>

  <!-- Sparklines Plugin -->
  <script src="{{ asset('vendor/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

  <!-- Simple Circles Plugin -->
  <script src="{{ asset('vendor/plugins/circles/circles.js') }}"></script>

  <!-- JvectorMap Plugin + US Map (more maps in plugin/assets folder) -->
  <script src="{{ asset('vendor/plugins/jvectormap/jquery.jvectormap.min.js') }}"></script>
  <script src="{{ asset('vendor/plugins/jvectormap/assets/jquery-jvectormap-us-lcc-en.js') }}"></script>
  <script src="{{ asset('/js/app.js') }}"></script>
  @yield('libraries')

  <!-- Theme Javascript -->
  <script src="{{ asset('assets/js/utility/utility.js') }}"></script>
  <script src="{{ asset('assets/js/demo/demo.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>

  <!-- Widget Javascript -->
  <script src="{{ asset('assets/js/demo/widgets.js') }}"></script>

@yield('scripts')

 <script src="https://cdn.tiny.cloud/1/xlhisqrt01di88akhyau1n9s2fwnbn6w77vmfoldzzizqsjx/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="{{ asset('tinymce/init-tinymce.js') }}"></script>

    <script src="https://www.google.com/recaptcha/api.js?render={{ env('SITE_KEY') }}"></script>
    <script>
    grecaptcha.ready(function() {
        grecaptcha.execute('<?php echo env('SITE_KEY'); ?>', {
            action: 'homepage'
        }).then(function(token) {
            document.getElementById('g_recaptcha_response').value = token;
        });
    });
    </script>

  <script type="text/javascript">
  jQuery(document).ready(function() {

    "use strict";

    // Init Theme Core
    Core.init();

     // Init Admin Panels on widgets inside the ".admin-panels" container
    $('.admin-panels').adminpanel({
      grid: '.admin-grid',
      draggable: true,
      preserveGrid: true,
      mobile: false,
      onStart: function() {
        // Do something before AdminPanels runs
      },
      onFinish: function() {
        $('.admin-panels').addClass('animated fadeIn').removeClass('fade-onload');

        // Init the rest of the plugins now that the panels
        // have had a chance to be moved and organized.
        // It's less taxing to organize empty panels
        demoHighCharts.init();
        runVectorMaps(); // function below
      },
      onSave: function() {
        $(window).trigger('resize');
      }
    });

    // Widget VectorMap
    function runVectorMaps() {

      // Jvector Map Plugin
      var runJvectorMap = function() {
        // Data set
        var mapData = [900, 700, 350, 500];
        // Init Jvector Map
        $('#WidgetMap').vectorMap({
          map: 'us_lcc_en',
          //regionsSelectable: true,
          backgroundColor: 'transparent',
          series: {
            markers: [{
              attribute: 'r',
              scale: [3, 7],
              values: mapData
            }]
          },
          regionStyle: {
            initial: {
              fill: '#E5E5E5'
            },
            hover: {
              "fill-opacity": 0.3
            }
          },
          markers: [{
            latLng: [37.78, -122.41],
            name: 'San Francisco,CA'
          }, {
            latLng: [36.73, -103.98],
            name: 'Texas,TX'
          }, {
            latLng: [38.62, -90.19],
            name: 'St. Louis,MO'
          }, {
            latLng: [40.67, -73.94],
            name: 'New York City,NY'
          }],
          markerStyle: {
            initial: {
              fill: '#a288d5',
              stroke: '#b49ae0',
              "fill-opacity": 1,
              "stroke-width": 10,
              "stroke-opacity": 0.3,
              r: 3
            },
            hover: {
              stroke: 'black',
              "stroke-width": 2
            },
            selected: {
              fill: 'blue'
            },
            selectedHover: {}
          },
        });
        // Manual code to alter the Vector map plugin to
        // allow for individual coloring of countries
        var states = ['US-CA', 'US-TX', 'US-MO',
          'US-NY'
        ];
        var colors = [bgWarningLr, bgPrimaryLr, bgInfoLr, bgAlertLr];
        var colors2 = [bgWarning, bgPrimary, bgInfo, bgAlert];
        $.each(states, function(i, e) {
          $("#WidgetMap path[data-code=" + e + "]").css({
            fill: colors[i]
          });
        });
        $('#WidgetMap').find('.jvectormap-marker')
          .each(function(i, e) {
            $(e).css({
              fill: colors2[i],
              stroke: colors2[i]
            });
          });
      }

      if ($('#WidgetMap').length) {
        runJvectorMap();
      }
    }

  });

  // Date picker for tender form
  $( function() {
    // $( "#datepicker1" ).datepicker({dateFormat:'dd-mm-yy'});
    // $( "#datepicker2" ).datepicker({dateFormat:'dd-mm-yy'});
  } );
  </script>

  <!-- END: PAGE SCRIPTS -->
</body>
</html>
