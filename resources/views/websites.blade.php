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
                                <h1 class="m-n font-thin h1 text-black">{{$site_settings->name}}
                                    -{{trans('messages.My Websites')}}</h1>
                                <small class="text-muted">{{trans('messages.My Websites')}}</small>
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
                                            <span class="h3  font-thin h3">{{trans('messages.Website Slots')}}</span>
                                            @if(Auth::user()->membership=='free')
                                                <div class="h1 text-info font-thin h1">{{count(\App\Websites::where('client_id',Auth::user()->id)->get())}}
                                                    /3 {{trans('messages.website slot(s) used')}}</div>
                                                <span class="text-muted text-xs">{{trans('messages.free slots')}}</span>
                                                <br><br>
                                            @endif
                                            @if(Auth::user()->membership=='paid')
                                                <div class="h1 text-info font-thin h1">{{count(\App\Websites::where('client_id',Auth::user()->id)->get())}}
                                                    /unlimited {{trans('messages.website slot(s) used')}}</div>
                                                <span class="text-muted text-xs">{{trans('messages.premium slots')}}</span>
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
                            <div class="col-md-4">
                                <div class="row row-sm text-center">
                                    <div class="col-xs-12">
                                        <div class="panel padder-v item">
                                            <span class="h3  font-thin h3">{{trans('messages.Points Available')}}</span>

                                            <div class="h1 text-info font-thin h1">{{Auth::user()->points}}</div>
                                            <span class="text-muted text-xs">{{trans('messages.points description')}}</span><br><br>
                                            <a href="/points" style="width:60%" class="btn btn-lg btn-success"><i
                                                        class="fa fa-shopping-cart"></i>{{trans('messages.Purchase')}}
                                            </a>

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
                                                <div class="h1 text-info font-thin h1">{{trans('messages.Free membership')}} </div>
                                                <span class="text-muted text-xs">{{trans('messages.free_membership')}} </span>
                                                <br><br>
                                            @endif
                                            @if(Auth::user()->membership=='paid')
                                                <div class="h1 text-info font-thin h1">{{trans('messages.Premium membership')}} </div>
                                                <span class="text-muted text-xs">{{trans('messages.premium_membership')}}
                                                    .</span><br><br>
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
                        </div>
                        <!-- / stats -->

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
                                        {{trans('messages.My Websites')}}
                                    </div>
                                    <div class="row wrapper">


                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped b-t b-light">
                                            <thead>
                                            <tr>
                                                <th>{{trans('messages.URL')}}</th>
                                                <th>{{trans('messages.ENABLE')}}</th>
                                                <th>{{trans('messages.ACTION')}}</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($websites as $website)
                                                <tr>
                                                    <td>{{$website->website}}</td>
                                                    @if($website->status==1)
                                                        <td>Running</td>
                                                    @else
                                                        <td>Waiting For approval</td>
                                                    @endif

                                                    <td><a href="/website/delete/{{$website->id}}" style="width:60%"
                                                           class="btn btn-danger btn-embossed">{{trans('messages.Delete')}}</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="pull-right">
                                        {!! $websites->render() !!}
                                    </div>
                                    <a data-toggle="modal" data-target="#myModal" type="button" style="width:100%"
                                       class="btn btn-lg btn-warning align-center"><i
                                                class="fa fa-plus"></i>{{trans('messages.Add a website')}}</a>

                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                         aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="/website/add" method="post">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title"
                                                            id="myModalLabel">{{trans('messages.Add a website')}}</h4>
                                                    </div>
                                                    <div class="modal-body">


                                                        @if(Session::has('success-msg'))
                                                            <p class="alert alert-danger">{{ Session::get('success-msg') }}</p>
                                                        @endif
                                                        <div class="input-group input-group-md">
                                                            <span class="input-group-addon"
                                                                  id="sizing-addon1">{{trans('messages.URL')}}</span>
                                                            <input type="url" name="website"
                                                                   value="{{ old('website') }}" class="form-control"
                                                                   placeholder="Website URL"
                                                                   aria-describedby="sizing-addon1" required>
                                                        </div><br>


                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">{{trans('messages.Close')}}</button>
                                                        <button type="submit"
                                                                class="btn btn-success">{{trans('messages.Save changes')}}</button>
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
                <!-- / main -->

            </div>


        </div>
    </div>



@stop