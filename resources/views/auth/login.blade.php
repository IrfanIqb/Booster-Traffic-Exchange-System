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

    <link rel="apple-touch-icon" href="/assets/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="/assets/css/site.min.css">

    <link rel="stylesheet" href="/assets/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="/assets/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="/assets/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="/assets/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="/assets/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="/assets/vendor/flag-icon-css/flag-icon.css">


    <!-- Page -->
    <link rel="stylesheet" href="/assets/css/pages/login.css">

    <!-- Fonts -->
    <link rel="stylesheet" href="/assets/fonts/web-icons/web-icons.min.css">
    <link rel="stylesheet" href="/assets/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>


    <!--[if lt IE 9]>
    <script src="/assets/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="/assets/vendor/media-match/media.match.min.js"></script>
    <script src="/assets/vendor/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="/assets/vendor/modernizr/modernizr.js"></script>
    <script src="/assets/vendor/breakpoints/breakpoints.js"></script>
    <script>
        Breakpoints();
    </script>
</head>
<body class="page-login layout-full">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<!-- Page -->
<div class="page animsition vertical-align text-center" data-animsition-in="fade-in"
     data-animsition-out="fade-out">>
    <div class="page-content vertical-align-middle">
        <div class="brand">
            <img class="brand-img" src="/logo.png" alt="...">
            <h2 class="brand-text">{{$site_settings->name}}</h2>
        </div>
        <p>{{trans('messages.Sign in to get in touch')}}</p>
        @if(Session::has('message'))
            <p class="alert alert-danger">{{ Session::get('message') }}</p>
        @endif
        <form name="form" method="post" action="/" class="form-validation">
            <div class="form-group">
                <label class="sr-only" for="inputEmail">{{trans('messages.Email')}}</label>
                <input type="email" class="form-control" id="inputEmail" name="email" placeholder="{{trans('messages.Email')}}" required>
                <input type="hidden" name="_token" value="{{csrf_token()}}">

            </div>
            <div class="form-group">
                <label class="sr-only" for="inputPassword">{{trans('messages.Password')}}</label>
                <input type="password" class="form-control" id="inputPassword" name="password" required
                       placeholder="{{trans('messages.Password')}}">
            </div>
            <div class="form-group clearfix">
                <div class="checkbox-custom checkbox-inline pull-left">
                    <input type="checkbox" id="inputCheckbox" name="checkbox">
                    <label for="inputCheckbox">{{trans('messages.Remember me')}}</label>
                </div>
                <a class="pull-right" data-toggle="modal" data-target="#myModal" style="cursor: pointer">{{trans('messages.Forgot password?')}}</a>
            </div>
            <button type="submit" class="btn btn-primary btn-block">{{trans('messages.Sign in')}}</button>
        </form>
        <p>{{trans('messages.Still no account? Please go to')}} <a href="/register">{{trans('messages.Register')}}</a></p>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="/password/email" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">{{trans('messages.Forgot password?')}}</h4>
                        </div>
                        <div class="modal-body">

                            <div class="input-group input-group-md">
                                <span class="input-group-addon" id="sizing-addon1">@</span>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" aria-describedby="sizing-addon1">
                            </div>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('messages.Close')}}</button>
                            <button type="submit" class="btn btn-success">{{trans('messages.Save changes')}}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>


        <footer class="page-copyright">
            <p>{{$site_settings->name}} {{trans('messages.Traffic Exchanger')}}</p>
            <p>{{trans('messages.© 2015. All RIGHT RESERVED.')}}</p>
        </footer>
    </div>
</div>
<!-- End Page -->


<!-- Core  -->
<script src="/assets/vendor/jquery/jquery.js"></script>
<script src="/assets/vendor/bootstrap/bootstrap.js"></script>
<script src="/assets/vendor/animsition/jquery.animsition.js"></script>
<script src="/assets/vendor/asscroll/jquery-asScroll.js"></script>
<script src="/assets/vendor/mousewheel/jquery.mousewheel.js"></script>
<script src="/assets/vendor/asscrollable/jquery.asScrollable.all.js"></script>
<script src="/assets/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>

<!-- Plugins -->
<script src="/assets/vendor/switchery/switchery.min.js"></script>
<script src="/assets/vendor/intro-js/intro.js"></script>
<script src="/assets/vendor/screenfull/screenfull.js"></script>
<script src="/assets/vendor/slidepanel/jquery-slidePanel.js"></script>

<script src="/assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

<!-- Scripts -->
<script src="/assets/js/core.js"></script>
<script src="/assets/js/site.js"></script>

<script src="/assets/js/sections/menu.js"></script>
<script src="/assets/js/sections/menubar.js"></script>
<script src="/assets/js/sections/sidebar.js"></script>

<script src="/assets/js/configs/config-colors.js"></script>
<script src="/assets/js/configs/config-tour.js"></script>

<script src="/assets/js/components/asscrollable.js"></script>
<script src="/assets/js/components/animsition.js"></script>
<script src="/assets/js/components/slidepanel.js"></script>
<script src="/assets/js/components/switchery.js"></script>
<script src="/assets/js/components/jquery-placeholder.js"></script>

<script>
    (function(document, window, $) {
        'use strict';

        var Site = window.Site;
        $(document).ready(function() {
            Site.run();
        });
    })(document, window, jQuery);
</script>

</body>

</html>