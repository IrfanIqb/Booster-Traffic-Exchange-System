@extends('layouts.master')


@section('content')


    <div id="content" class="app-content" role="main">
        <div class="app-content-body ">


            <div class="hbox hbox-auto-xs hbox-auto-sm">
                <!-- main -->
                <div class="col">
                    <!-- main header -->
                    <div class="bg-light lter b-b wrapper-md">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <h1 class="m-n font-thin h1 text-black">{{$site_settings->name}}- Withdraw Points</h1>
                                <small class="text-muted">Withdraw Points</small>
                            </div>
                        </div>
                    </div>
                    <!-- / main header -->
                    <div class="wrapper-md">
                        <!-- stats -->
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default">
                                    <div class="panel-heading font-bold">{{trans('messages.Withdraw Points(1 point')}}
                                        = {{$site_settings->point_value}})
                                    </div>
                                    <div class="panel-body">
                                        @if(Session::has('success_message'))
                                            <p class="alert alert-success">{{ Session::get('success_message') }}</p>
                                        @endif

                                        <form role="form" method="post" action="/withdraw">
                                            <div class="form-group">
                                                <label>{{trans('messages.Paypal Email')}}</label>
                                                <input type="email" name="email" class="form-control"
                                                       placeholder="{{trans('messages.Paypal Email')}}" required>
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            </div>

                                            <div class="form-group">
                                                <label>{{trans('messages.Points To withdraw')}}</label>
                                                <input type="number" name="points"
                                                       class="form-control" placeholder="{{trans('messages.Points To withdraw')}}" required
                                                >
                                            </div>


                                            <button type="submit" class="btn btn-sm btn-primary">{{trans('messages.Withdraw')}}
                                            </button>
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