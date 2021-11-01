@extends('layouts.master')

@section('extra_js')

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
                            <a data-toggle="modal" data-target="#myModal" type="button"
                               class="btn btn-lg btn-primary pull-right" style="margin-right: 10px"><i class="fa fa-plus"></i>{{trans('messages.Add
                                Video')}}</a>
                        </div>

                    </div>
                    <!-- / main header -->
                    <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">


                        @if(Session::has('success_msg'))
                            <p class="alert alert-success">{{ Session::get('success_msg') }}</p>
                        @endif
                        @if(Session::has('error_msg'))
                            <p class="alert alert-danger">{{ Session::get('error_msg') }}</p>
                            @endif
                        <!-- stats -->
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
                                                {{trans('messages.Videos')}}
                                            </div>
                                            <div class="row wrapper">


                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-striped b-t b-light">
                                                    <thead>
                                                    <tr>
                                                        <th>{{trans('messages.VIDEO')}}</th>
                                                        <th>{{trans('messages.ACTION')}}</th>


                                                    </tr>
                                                    </thead>
                                                    @foreach($videos as $video)
                                                        <tbody>
                                                        <tr>
                                                            <td> <iframe width="300" height="169" style="padding-left: 20px" src="https://www.youtube.com/embed/{{$video->embed_code}}?controls=0" frameborder="0" allowfullscreen></iframe>
                                                            </td>
                                                            <td><a href="/video/delete/{{$video->id}}"
                                                                   class="btn btn-danger btn-embossed "><i
                                                                            class="fa fa-trash"></i>{{trans('messages.Delete')}} </a></td>

                                                        </tr>
                                                        </tbody>
                                                    @endforeach
                                                </table>


                                            </div>

                                            <div class="pull-right">
                                                {!! $videos->render() !!}
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <!-- / stats -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="/video/add" method="post">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span
                                                                aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">{{trans('messages.Add Videos')}}</h4>
                                                </div>
                                                <div class="modal-body">


                                                    @if(Session::has('success-msg'))
                                                        <p class="alert alert-danger">{{ Session::get('success-msg') }}</p>
                                                    @endif
                                                    <div class="input-group input-group-md">
                                                        <span class="input-group-addon" id="sizing-addon1">{{trans('messages.Video URL')}}</span>
                                                        <input type="url" name="embed_code" value="{{ old('embed_code') }}"
                                                               class="form-control" placeholder="https://www.youtube.com/watch?v=IrgqUZaeRuc"
                                                               aria-describedby="sizing-addon1" required>
                                                    </div>

                                                    <div class="input-group input-group-md">
                                                        <span class="input-group-addon" id="sizing-addon1"> {{trans('messages.Points')}}</span>
                                                        <input type="number" name="points"
                                                               value="{{ old('points') }}" class="form-control"
                                                               placeholder="Set Points"
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
                    <!-- / main -->

                </div>


            </div>
        </div>



@stop