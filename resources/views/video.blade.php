@extends('layouts.master')

@section('extra_js')

    <script>
        // 2. This code loads the IFrame Player API code asynchronously.
        var tag = document.createElement('script');

        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        // 3. This function creates an <iframe> (and YouTube player)
        //    after the API code downloads.
        var player;
        function onYouTubeIframeAPIReady() {
            $video_id = $('#player').attr("data-video");
            player = new YT.Player('player', {
                height: '300',
                width: '600',
                videoId: $video_id,
                playerVars: {
                    'autoplay': 0,
                    'controls': 0,
                    'rel' : 0,
                    'fs' : 0,
                },
                events: {
                    'onStateChange': onPlayerStateChange
                }
            });
        }



        // 5. The API calls this function when the player's state changes.
        //    The function indicates that when playing a video (state=1),
        //    the player should play for six seconds and then stop.
        var done = false;
        function onPlayerStateChange(event) {
            if(event.data === 0) {
                alert("Successfully Received Points");
                $video_id = $('#player').attr("data-video");
                $.ajax({
                    'type': 'GET',
                    'url': '/api/media',
                    data: {video_id: $video_id},
                    'success': function (response) {
                    }
                });

            }
        }
        function stopVideo() {
            player.stopVideo();
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
                                <h1 class="m-n font-thin h1 text-black">{{$site_settings->name}}-{{trans('messages.Media Exchange')}}</h1>
                                <small class="text-muted">{{trans('messages.Media Exchange (View Videos And Earn points)')}}</small>

                            </div>
                        </div>
                    </div>
                    <!-- / main header -->
                    <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">

                        <div class="row">
                            <div class="col-md-12">
                                <a href="/video_list" class="btn btn-info btn-md pull-right "><i
                                            class="fa fa-link"></i>{{trans('messages.My Videos')}} </a>

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
                                        Videos
                                    </div>
                                    <div class="row wrapper">


                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped b-t b-light">
                                            <thead>
                                            <tr>
                                                <th>{{trans('messages.VIDEO')}}</th>
                                                <th>{{trans('messages.POINTS TO BE AWARDED')}}</th>
                                                <th>{{trans('messages.SHUFFLE')}}</th>


                                            </tr>
                                            </thead>
                                                <tbody>
                                                @if(isset($videos))
                                                    <tr>
                                                    <td> <div id="player" data-video="{{$videos->embed_code}}"></div></td>

                                                    <td><b>{{$videos->points}} {{trans('messages.POINTS')}}</b></td>
                                                        <td><a href="javascript:location.reload(true)" class="btn btn-primary btn-md  "><i
                                                                        class="fa fa-refresh"></i>{{trans('messages.Refresh')}} </a></td>


                                                    </tr>
                                                    @endif

                                                </tbody>
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