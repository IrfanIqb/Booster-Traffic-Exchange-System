<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{$site_settings->name}} Traffic Exchanger</title>
    <meta name="description" content="{{$site_settings->name}} Traffic Exchanger" />
    <meta name="keywords" content="{{$site_settings->meta}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" href="/libs/assets/animate.css/animate.css" type="text/css" />
    <link rel="stylesheet" href="/libs/assets/font-awesome/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="/libs/assets/simple-line-icons/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="/libs/jquery/bootstrap/dist/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="/css/font.css" type="text/css" />
    <link rel="stylesheet" href="/css/app.css" type="text/css" />
    <style>
        .loading-image {
            position: absolute;
            top: 50%;
            left: 50%;
            z-index: 10;
        }
        .loader
        {
            display: none;
            width:250px;
            height: 250px;
            position: fixed;
            overflow-x: hidden;
            overflow-y: hidden;
            top: 50%;
            left: 50%;
            text-align:center;
            margin-left: -50px;
            margin-top: -100px;
            z-index:2;
        }
    </style>
    @yield('extra_css')


</head>
<body>
<div class="loader">
    <center>
        <img class="loading-image" src="/loading.gif" alt="loading..">
    </center>
</div>
<div class="app app-header-fixed ">



   @include('administrator.layouts.header')

   @include('administrator.layouts.aside')


           <!-- content -->
                @yield('content')
        <!-- / content -->

    @include('administrator.layouts.footer')


</div>

<script src="/libs/jquery/jquery/dist/jquery.js"></script>
<script src="/libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<script src="/js/ui-load.js"></script>
<script src="/js/ui-jp.config.js"></script>
<script src="/js/ui-jp.js"></script>
<script src="/js/ui-nav.js"></script>
<script src="/js/ui-toggle.js"></script>
<script>
    $.ajax({
        // your ajax code
        beforeSend: function(){
            $('.loader').show()
        },
        complete: function(){
            $('.loader').hide();
        }
    });
</script>
@yield('extra_js')
</body>
</html>
