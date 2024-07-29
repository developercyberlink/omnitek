<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{ env('APP_KEYWORDS') }}" />
    <meta name="description" content="{{ env('APP_DESCRIPTION') }}">
    <meta name="author" content="{{ env('APP_NAME') }}">
    <title>{{ config('app.name', 'Content Management System') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/skin/default_skin/css/theme.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/skin/default_skin/css/theme2.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/skin/default_skin/css/theme3.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/admin-tools/admin-forms/css/admin-forms.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon.png') }}">
</head>
<body class="external-page external-alt sb-l-c sb-r-c">
    <!-- Start: Main -->
    <div id="main" class="animated fadeIn">
        <!-- Start: Content-Wrapper -->
        <section id="content_wrapper">
            <section id="content">

                <div class="admin-form theme-info mw500" id="login">
                    <div class="row table-layout">
                        {{-- <a href="#" title="Return to Dashboard">
                            <img src="{{ asset('themes-assets/images/logo.png') }}" title="AdminDesigns Logo"
                                class="center-block img-responsive" style="max-width: 500px;">
                        </a>  --}}
                        <h3 class="text-center"> {{ $setting->site_name }} </h3>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @yield('content')

                    <div class="login-links">
                        <p>
                            <a class="btn btn-link" href="http://cyberlink.com.np/" target="_blank">
                                {{ $setting->copyright_text }}
                            </a>
                        </p>

                    </div>

                </div>
            </section>
        </section>
    </div>

    <!-- END: PAGE SCRIPTS --> 
<script src="https://www.google.com/recaptcha/api.js?render={{env('SITE_KEY')}}"></script>
<script>
grecaptcha.ready(function() {
    grecaptcha.execute('{{env("SITE_KEY")}}', {action: 'homepage'}).then(function(token) {
       document.getElementById('g_recaptcha_response').value=token;
    });
});
</script>
</body>
</html>
