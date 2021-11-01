@extends('layouts.master')

@section('extra_js')
    <script id="facebook-jssdk" src="//connect.facebook.net/en_US/all.js"></script>

    <script>
        window.fbAsyncInit = function () {
            FB.init({
                appId: '1022133437809159',
                xfbml: true,
                version: 'v2.5'
            });
        };

        function fb_share($link) {
            FB.ui({
                method: 'feed',
                link: $link
            }, function (response) {
                if (response !== null && typeof response.post_id !== 'undefined') {
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
                                <h1 class="m-n font-thin h1 text-black">{{$site_settings->name}}-{{trans('messages.My Links')}}</h1>
                                <small class="text-muted">{{trans('messages.My Links')}}</small>
                            </div>
                        </div>
                    </div>
                    <!-- / main header -->
                    <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">


                        <div class="row">
                            <div class="col-md-12">
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
                                        @if(Session::has('success_msg'))
                                            <p class="alert alert-success">{{ Session::get('success_msg') }}</p>
                                        @endif
                                        @if(Session::has('error_msg'))
                                            <p class="alert alert-danger">{{ Session::get('error_msg') }}</p>
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
                                                <th>{{trans('messages.Points')}}</th>
                                                <th>{{trans('messages.Action')}}</th>

                                            </tr>
                                            </thead>
                                            @foreach($websites as $website)
                                                <tbody>
                                                <tr>
                                                    <td>{{$website->link}}</td>
                                                    <td>{{$website->points}}</td>
                                                    <td><a href="/link/delete/{{$website->id}}"
                                                           class="btn btn-danger btn-embossed "><i
                                                                    class="fa fa-trash"></i>{{trans('messages.Delete')}} </a></td>

                                                </tr>
                                                </tbody>
                                            @endforeach
                                        </table>
                                        <div class="pull-right">
                                            {!! $websites->render() !!}
                                        </div>
                                        <a data-toggle="modal" data-target="#myModal" type="button" style="width:100%"
                                           class="btn btn-lg btn-warning align-center"><i class="fa fa-plus"></i>{{trans('messages.Add Link To Share')}}</a>

                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                             aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="/social/add" method="post">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">{{trans('messages.Add Link To Share')}}</h4>
                                                        </div>
                                                        <div class="modal-body">


                                                            @if(Session::has('success-msg'))
                                                                <p class="alert alert-danger">{{ Session::get('success-msg') }}</p>
                                                            @endif
                                                            <div class="input-group input-group-md">
                                                                <span class="input-group-addon" id="sizing-addon1">{{trans('messages.Link To Share')}}</span>
                                                                <input type="url" name="link" value="{{ old('link') }}"
                                                                       class="form-control" placeholder="{{trans('messages.Link To Share')}}"
                                                                       aria-describedby="sizing-addon1" required>
                                                            </div>

                                                            <div class="input-group input-group-md">
                                                                <span class="input-group-addon" id="sizing-addon1"> {{trans('messages.Points/Share')}}</span>
                                                                <input type="number" name="points"
                                                                       value="{{ old('points') }}" class="form-control"
                                                                       placeholder="{{trans('messages.Points/Share')}}"
                                                                       aria-describedby="sizing-addon1" required>
                                                            </div>


                                                            <input type="hidden" name="_token" value="{{csrf_token()}}">


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">{{trans('messages.Close')}}
                                                            </button>
                                                            <button type="submit" class="btn btn-success">{{trans('messages.Save changes')}}
                                                            </button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>

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