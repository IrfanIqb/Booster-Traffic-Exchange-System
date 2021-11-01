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
                                <h1 class="m-n font-thin h1 text-black">{{$site_settings->name}}-Transfers</h1>
                                <small class="text-muted">Transfers</small>
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
                                <a href="/transfers" class="btn btn-info btn-md pull-right "><i
                                            class="fa fa-paper-plane"></i>Transfer Points</a>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Transfers
                                    </div>
                                    <div class="row wrapper">


                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped b-t b-light">
                                            <thead>
                                            <tr>
                                                <th>From Email</th>
                                                <th>To Email</th>
                                                <th>Points Transfered</th>

                                            </tr>
                                            </thead>
                                            @if(sizeof($transfers)>0)
                                                @foreach($transfers as $transfer)
                                                    <tbody>
                                                    <tr>
                                                        <td>{{$transfer->from}}</td>
                                                        <td>{{$transfer->to}}</td>
                                                        <td>{{$transfer->amount}}</td>

                                                    </tr>
                                                    </tbody>
                                                @endforeach
                                            @endif
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



