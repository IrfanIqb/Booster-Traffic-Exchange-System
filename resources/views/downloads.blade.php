@extends('layouts.master')

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
                                <h1 class="m-n font-thin h1 text-black">{{$site_settings->name}}-{{trans('messages.My Downloads')}}</h1>
                                <small class="text-muted">{{trans('messages.My Downloads')}}</small>
                            </div>
                        </div>
                    </div>
                    <!-- / main header -->
                    <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">
                        <!-- stats -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row row-sm text-center">

                                    <div class="col-xs-12">
                                        <div class="panel padder-v item">
                                            <span class="h3  font-thin h3">{{trans('messages.ALEXA TOOLBAR (REQUIRED)')}}</span><br>
                                            <span class="text-muted text-xs">{{trans('messages.alexa')}}</span><br><br>
                                            <a class="btn btn-info" href="http://www.alexa.com/toolbar" target="_blank"><i
                                                        class="fa fa-cloud-download"></i> {{trans('messages.Download Alexa Toolbar')}}</a>
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