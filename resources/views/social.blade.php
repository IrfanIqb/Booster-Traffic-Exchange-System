@extends('layouts.master')

@section('extra_js')
    <script id="facebook-jssdk" src="//connect.facebook.net/en_US/all.js"></script>

    <script>
        window.fbAsyncInit = function () {
            FB.init({
                appId: '{{env('APP_ID')}}',
                xfbml: true,
                version: 'v2.5'
            });
        };

        function fb_share($link) {
            FB.ui({
                method: 'feed',
                link: $link
            }, function (response) {
                if (response !== null &&  response.post_id !== 'undefined') {
                    getPoints($link);

                }
            });

        }


        function getPoints($link) {
            $.ajax({
                'type': 'GET',
                'url': '/api/social',
                data: {link: $link},
                'success': function (response) {
                    window.location.reload();
                }
            });
        }


    </script>



@stop

@section('content')


    <div id="content" class="app-content" role="main">
        <div class="app-content-body ">


            <div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="
    app.settings.asideFolded = false;
    app.settings.asideDock = false;
  ">
                <!-- main -->
                <div class="col">
                    <!-- main header -->
                    <div class="bg-light lter b-b wrapper-md">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <h1 class="m-n font-thin h1 text-black">{{$site_settings->name}}-{{trans('messages.Social Exchange')}}</h1>
                                <small class="text-muted">{{trans('messages.Social Exchange (Share Links And Earn points)')}}</small>
                            </div>
                        </div>
                    </div>
                    <!-- / main header -->
                    <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">

                        @if(Session::has('success_msg'))
                            <p class="alert alert-success">{{ Session::get('success_msg') }}</p>
                        @endif
                        @if(Session::has('error_msg'))
                            <p class="alert alert-danger">{{ Session::get('error_msg') }}</p>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <a href="/links" class="btn btn-info btn-md pull-right "><i
                                            class="fa fa-link"></i>{{trans('messages.My Links')}} </a>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        Links
                                    </div>
                                    <div class="row wrapper">


                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped b-t b-light">
                                            <thead>
                                            <tr>
                                                <th>{{trans('messages.URL')}}</th>
                                                <th>{{trans('messages.POINTS TO BE AWARDED')}}</th>
                                                <th>{{trans('messages.Share')}} </th>

                                            </tr>
                                            </thead>
                                            @foreach($websites as $website)
                                                <tbody>
                                                <tr>
                                                    <td>{{$website->link}}</td>
                                                    <td>{{$website->points}}</td>
                                                    <td><a onclick="fb_share('{{$website->link}}')"
                                                           class="btn btn-primary btn-embossed "><i
                                                                    class="fa fa-facebook"></i> {{trans('messages.Share')}} </a></td>


                                                </tr>
                                                </tbody>
                                            @endforeach
                                        </table>


                                    </div>


                                </div>

                            </div>

                        </div>


                    </div>
                </div>
                <!-- / main -->

            </div>


        </div>
    </div>



@stop