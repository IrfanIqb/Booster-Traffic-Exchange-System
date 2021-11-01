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
                                <h1 class="m-n font-thin h1 text-black">{{$site_settings->name}}-{{trans('messages.Manual Exchange')}}</h1>
                                <small class="text-muted">{{trans('messages.Manual Exchange')}}</small>
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
                                        {{trans('messages.Websites')}}
                                    </div>
                                    <div class="row wrapper">


                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped b-t b-light">
                                            <thead>
                                            <tr>
                                                <th>{{trans('messages.URL')}}</th>
                                                <th>{{trans('messages.ACTION')}}</th>

                                            </tr>
                                            </thead>
                                            @if(sizeof($websites)>0)
                                                @foreach($websites as $website)
                                                    <tbody>
                                                    <tr>
                                                        <td>{{$website->website}}</td>
                                                        <td><a target="_blank" href="{{$website->website}}"
                                                               id="link_click"  class="btn btn-primary btn-embossed "><i
                                                                        class="fa fa-forward"></i>{{trans('messages.Visit Site')}} </a></td>

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


@section('extra_js')
    @if(sizeof($websites)>0)

        <script>

            $('#link_click').on('click', function () {
                $.ajax({
                    'url': '/api/check',
                    'type': 'GET',
                    'success': function (response) {

                        window.location = "/api/manual_exchange/{{$website->client_id}}?website={{$website->website}}";

                        return true;
                    },
                    'error': function (response) {
                        return false;
                    }
                });

            });

        </script>

    @endif

@stop

