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
                                <h1 class="m-n font-thin h1 text-black">{{$site_settings->name}}-{{trans('messages.Dashboard')}}</h1>
                                <small class="text-muted">{{trans('messages.Welcome to booster app')}}</small>
                            </div>
                        </div>
                    </div>
                    <!-- / main header -->
                    <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">
                        <!-- stats -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row row-sm text-center">
                                    <div class="col-xs-12">
                                        <div class="panel padder-v item">
                                            <span class="h3  font-thin h3">{{trans('messages.Points Available')}}</span>

                                            <div class="h1 text-info font-thin h1">{{Auth::user()->points}}</div>
                                            <span class="text-muted text-xs"> {{trans('messages.points description')}}</span><br><br>
                                            <a href="/points" style="width:60%" class="btn btn-lg btn-success"><i
                                                        class="fa fa-shopping-cart"></i>{{trans('messages.Purchase')}}</a>

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
                                            <span class="h3  font-thin h3">{{trans('messages.Membership Type')}}</span>
                                            @if(Auth::user()->membership=='free')
                                                <div class="h1 text-info font-thin h1">{{trans('messages.Free membership')}}</div>
                                                <span class="text-muted text-xs"> {{trans('messages.free_membership')}} </span>
                                                <br><br>
                                            @endif
                                            @if(Auth::user()->membership=='paid')
                                                <div class="h1 text-info font-thin h1">{{trans('messages.Premium membership')}}</div>
                                                <span class="text-muted text-xs"> {{trans('messages.premium_membership')}}</span>
                                                <br><br>
                                            @endif
                                            <a href="/subscriptions" style="width:60%" class="btn btn-lg btn-primary"><i
                                                        class="fa fa-info"></i>{{trans('messages.More Info')}}</a>

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
                                            <span class="h3  font-thin h3">{{trans('messages.Website Slots')}}</span>
                                            @if(Auth::user()->membership=='free')
                                                <div class="h1 text-info font-thin h1">{{count(\App\Websites::where('client_id',Auth::user()->id)->get())}}
                                                    /3 {{trans('messages.website slot(s) used')}}
                                                </div>
                                                <span class="text-muted text-xs"> {{trans('messages.free slots')}}</span>
                                                <br><br>
                                            @endif
                                            @if(Auth::user()->membership=='paid')
                                                <div class="h1 text-info font-thin h1">{{count(\App\Websites::where('client_id',Auth::user()->id)->get())}}
                                                    /unlimited  {{trans('messages.website slot(s) used')}}
                                                </div>
                                                <span class="text-muted text-xs"> {{trans('messages.premium slots')}}</span>
                                                <br><br>
                                            @endif
                                            <a href="/subscriptions" style="width:60%" class="btn btn-lg btn-danger"><i
                                                        class="fa fa-plus"></i>{{trans('messages.Add Slots')}}</a>

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
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading font-bold">{{trans('messages.Hits Received')}}</div>
                                    <div class="panel-body">
                                        <div ui-jq="plot" ui-options="
              [
                { data: {{ json_encode($graph_values) }}, points: { show: true, radius: 6}, splines: { show: true, tension: 0.45, lineWidth: 5, fill: 0 } }
              ],
              {
                colors: ['#23b7e5'],
                series: { shadowSize: 3 },
                xaxis:{
                  font: { color: '#ccc' },
                  position: 'bottom',
                  ticks: {{ json_encode($graph_ticks) }}
                                                },
                                                yaxis:{ font: { color: '#ccc' } },
                                                grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#ccc' },
                                                tooltip: true,
                                                tooltipOpts: { content: '%x.1 is %y.4',  defaultTheme: false, shifts: { x: 0, y: 20 } }
                                              }
                                            " style="height:240px">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading font-bold">{{trans('messages.Points Earned')}}</div>
                                    <div class="panel-body">
                                        <div ui-jq="plot" ui-options="
              [
                { data: {{ json_encode($graph_points) }}, points: { show: true, radius: 6}, splines: { show: true, tension: 0.45, lineWidth: 5, fill: 0 } }
              ],
              {
                colors: ['#23b7e5'],
                series: { shadowSize: 3 },
                xaxis:{
                  font: { color: '#ccc' },
                  position: 'bottom',
                  ticks: {{ json_encode($graph_ticks) }}
                                                },
                                                yaxis:{ font: { color: '#ccc' } },
                                                grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#ccc' },
                                                tooltip: true,
                                                tooltipOpts: { content: '%x.1 is %y.4',  defaultTheme: false, shifts: { x: 0, y: 20 } }
                                              }
                                            " style="height:240px">
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