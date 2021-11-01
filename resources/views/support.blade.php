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
                                <h1 class="m-n font-thin h1 text-black">{{$site_settings->name}}-{{trans('messages.Support')}}</h1>
                                <small class="text-muted">{{trans('messages.Support')}}</small>
                            </div>
                        </div>
                    </div>
                    <!-- / main header -->
                    <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">
                        <!-- stats -->
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default">
                                    <div class="panel-heading font-bold">{{trans('messages.Support form')}}</div>
                                    <div class="panel-body">
                                        @if(Session::has('message'))
                                            <p class="alert alert-success">{{ Session::get('message') }}</p>
                                        @endif
                                        <form role="form" method="post" action="/support">
                                            <div class="form-group">
                                                <label>{{trans('messages.Message Subject')}}</label>
                                                <input type="text" name="subject" class="form-control"
                                                       placeholder="{{trans('messages.Message Subject')}}" required>
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            </div>

                                            <div class="form-group">
                                                <label>{{trans('messages.Your email address')}}</label>
                                                <input type="email" name="email" class="form-control"
                                                       placeholder="{{trans('messages.Your email address')}}" required>
                                            </div>

                                            <div class="form-group">
                                                <label> {{trans('messages.How can we help you today?')}}</label>
                                                <textarea class="form-control" name="message"
                                                          title="{{trans('messages.How can we help you today?')}}" required></textarea></div>


                                            <button type="submit" class="btn btn-sm btn-primary">{{trans('messages.Send Message')}}</button>
                                        </form>
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