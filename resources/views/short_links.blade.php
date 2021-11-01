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
                                <h1 class="m-n font-thin h1 text-black">{{$site_settings->name}}-Short Links</h1>
                                <small class="text-muted">Share Short Links And Earn Points</small>
                            </div>

                        </div>
                    </div>
                    <!-- / main header -->
                    <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">

                        @if(Session::has('message'))
                            <p class="alert alert-success">{{ Session::get('message') }}</p>
                        @endif


                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Short Links
                                    </div>
                                    <div class="row wrapper">


                                    </div>
                                    <div class="table-responsive">
                                        <table class="table m-b-none" ui-jq="footable" data-filter="#filter" data-page-size="10">
                                            <thead>
                                            <tr>
                                                <th>Website Link</th>
                                                <th>Short Link</th>
                                                <th>Status</th>


                                            </tr>
                                            </thead>
                                            @if(sizeof($websites)>0)
                                                @foreach($websites as $website)
                                                    <tbody>
                                                    <tr>
                                                        <td>{{$website->website}}</td>
                                                        <td>{{$website->short_link}}</td>
                                                        @if($website->status==1)
                                                            <td>Running</td>
                                                        @else
                                                            <td>Waiting For approval</td>
                                                        @endif
                                                    </tr>
                                                    </tbody>
                                                @endforeach
                                            @endif
                                        </table>

                                        <tfoot class="hide-if-no-paging">
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <ul class="pagination"></ul>
                                            </td>
                                        </tr>
                                        </tfoot>


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



