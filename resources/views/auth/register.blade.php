<!DOCTYPE html>
<html class="no-js before-run" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="">
    <meta name="description" content="{{$site_settings->meta}}" />
    <meta name="keywords" content="{{$site_settings->meta}}" />

    <title>{{$site_settings->name}} {{trans('messages.Traffic Exchanger')}}</title>

    <link rel="apple-touch-icon" href="../../assets/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="../../assets/images/favicon.ico">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="../../assets/css/site.min.css">

    <link rel="stylesheet" href="../../assets/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="../../assets/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="../../assets/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="../../assets/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="../../assets/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="../../assets/vendor/flag-icon-css/flag-icon.css">


    <!-- Page -->
    <link rel="stylesheet" href="../../assets/css/pages/register.css">

    <!-- Fonts -->
    <link rel="stylesheet" href="../../assets/fonts/web-icons/web-icons.min.css">
    <link rel="stylesheet" href="../../assets/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>


    <!--[if lt IE 9]>
    <script src="../../assets/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="../../assets/vendor/media-match/media.match.min.js"></script>
    <script src="../../assets/vendor/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="../../assets/vendor/modernizr/modernizr.js"></script>
    <script src="../../assets/vendor/breakpoints/breakpoints.js"></script>
    <script>
        Breakpoints();
    </script>
</head>
<body class="page-register layout-full">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<!-- Page -->
<div class="page animsition vertical-align text-center" data-animsition-in="fade-in"
     data-animsition-out="fade-out">
    <div class="page-content vertical-align-middle">
        <div class="brand">
            <img class="brand-img" src="/logo.png" alt="...">
            <h2 class="brand-text">{{$site_settings->name}}</h2>
        </div>
        <p>{{trans('messages.Sign up to boost your website')}}</p>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has('success_msg'))
            <p class="alert alert-success">{{ Session::get('success_msg') }}</p>
        @endif
        @if(Session::has('error_msg'))
            <p class="alert alert-danger">{{ Session::get('error_msg') }}</p>
        @endif

        <form name="form" method="post" action="/register/{{$ref_id}}" class="form-validation">
        <div class="form-group">
                <label class="sr-only" for="inputName">{{trans('messages.Name')}}</label>
                <input type="text" class="form-control" id="inputName" placeholder="{{trans('messages.Name')}}" name="username" required>
                 <input type="hidden" name="_token" value="{{csrf_token()}}">
                 <input type="hidden" id="ip" name="ip" value="">
            </div>
            <div class="form-group">
                <label class="sr-only" for="inputEmail">{{trans('messages.Email')}}</label>
                <input type="email" class="form-control" id="inputEmail" name="email" placeholder="{{trans('messages.Email')}}" required>
            </div>
            <div class="form-group">
                <label class="sr-only" for="inputPassword">{{trans('messages.Password')}}</label>
                <input type="password" class="form-control" id="inputPassword" name="password"
                       placeholder="{{trans('messages.Password')}}" required>
            </div>


            <button type="submit" class="btn btn-primary btn-block">{{trans('messages.Register')}}</button>
        </form>
        <p> {{trans('messages.Have account already? Please go to')}}<a href="/login"> {{trans('messages.Sign In')}}</a></p>

        <footer class="page-copyright">
            <p>{{$site_settings->name}} {{trans('messages.Traffic Exchanger')}}</p>
            <p>{{trans('messages.© 2015. All RIGHT RESERVED.')}}</p>
        </footer>
    </div>
</div>
<!-- End Page -->


<!-- Core  -->
<script src="../../assets/vendor/jquery/jquery.js"></script>
<script src="../../assets/vendor/bootstrap/bootstrap.js"></script>
<script src="../../assets/vendor/animsition/jquery.animsition.js"></script>
<script src="../../assets/vendor/asscroll/jquery-asScroll.js"></script>
<script src="../../assets/vendor/mousewheel/jquery.mousewheel.js"></script>
<script src="../../assets/vendor/asscrollable/jquery.asScrollable.all.js"></script>
<script src="../../assets/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>

<!-- Plugins -->
<script src="../../assets/vendor/switchery/switchery.min.js"></script>
<script src="../../assets/vendor/intro-js/intro.js"></script>
<script src="../../assets/vendor/screenfull/screenfull.js"></script>
<script src="../../assets/vendor/slidepanel/jquery-slidePanel.js"></script>

<script src="../../assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

<!-- Scripts -->
<script src="../../assets/js/core.js"></script>
<script src="../../assets/js/site.js"></script>

<script src="../../assets/js/sections/menu.js"></script>
<script src="../../assets/js/sections/menubar.js"></script>
<script src="../../assets/js/sections/sidebar.js"></script>

<script src="../../assets/js/configs/config-colors.js"></script>
<script src="../../assets/js/configs/config-tour.js"></script>

<script src="../../assets/js/components/asscrollable.js"></script>
<script src="../../assets/js/components/animsition.js"></script>
<script src="../../assets/js/components/slidepanel.js"></script>
<script src="../../assets/js/components/switchery.js"></script>
<script src="../../assets/js/components/jquery-placeholder.js"></script>

<script>
    (function(document, window, $) {
        'use strict';

        var Site = window.Site;
        $(document).ready(function() {
            Site.run();
        });
    })(document, window, jQuery);
</script>

<script type="application/javascript">
    function getip(jsonp){

        $('#ip').val(jsonp.ip)
    }
</script>

<script type="application/javascript" src="https://api.ipify.org?format=jsonp&callback=getip"></script>

</body>

</html>