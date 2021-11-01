@extends('layouts.master')

@section('extra_js')
    <script src="js/source.js"></script>

@endsection

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
                                <h1 class="m-n font-thin h1 text-black">{{$site_settings->name}}-{{trans('messages.My Traffic Exchange Sessions')}}</h1>
                                <small class="text-muted">{{trans('messages.My Traffic Exchange Sessions')}}</small>
                            </div>
                        </div>
                    </div>
                    <!-- / main header -->
                    <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">
                        <!-- stats -->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row row-sm text-center">
                                    <div class="col-xs-12">
                                        <div class="panel padder-v item">
                                            <span class="h3  font-thin h3">{{trans('messages.Booster Extensions')}}</span><br>
                                            <span class="text-muted text-xs">{{trans('messages.extension')}}</span><br><br>
                                            <a target="_blank" style="width:50%;" class="btn btn-lg btn-success"
                                               href="http://www.alexa.com/toolbar">{{trans('messages.Alexa Toolbar')}}</a>

                                            <div class="top text-right w-full">
                                                <i class=" text-warning m-r-sm"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row row-sm text-center">
                                    <div class="col-xs-12">
                                        <div class="panel padder-v item">
                                            <span class="h3  font-thin h3">{{trans('messages.Points Available')}}</span>

                                            <div class="h1 text-info font-thin h1">{{Auth::user()->points}}</div>
                                            <span class="text-muted text-xs">{{trans('messages.points description')}}</span><br><br>
                                            <a href="/points" style="width:60%" class="btn btn-lg btn-success"><i
                                                        class="fa fa-shopping-cart"></i>{{trans('messages.Purchase')}}</a>

                                            <div class="top text-right w-full">
                                                <i class=" text-warning m-r-sm"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                        <!-- / stats -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                       {{trans('messages. My Sessions(Allow popups)')}}
                                    </div>
                                    <div class="row wrapper">


                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped b-t b-light">
                                            <thead>
                                            <tr>
                                                <th>{{trans('messages.IP')}}</th>
                                                <th>{{trans('messages.POINTS AVAILABLE')}}</th>
                                                <th>{{trans('messages.STATUS')}}</th>
                                                <th>{{trans('messages.ACTION')}}</th>
                                                <th>{{trans('messages.PROGRESS')}}</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{{Request::getClientIp()}}</td>
                                                <td>{{Auth::user()->points}}</td>
                                                <td id="status">Not Running</td>
                                                <td><a id="source" class="btn btn-primary btn-embossed"> <i
                                                                class="glyphicon glyphicon-new-window"></i>
                                                        {{trans('messages.Start Regular Browser Session')}}</a><a id="pause"
                                                                                      class="btn btn-danger btn-embossed">
                                                        <i class="glyphicon glyphicon-alert"></i>{{trans('messages. Stop Regular Browser
                                                        Session')}}</a></td>
                                                <td>
                                                    <div id="progress" class="progress-bar progress-bar-info"
                                                         role="progressbar"  style="width: 30%;">

                                                    </div>
                                                </td>
                                            </tr>



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