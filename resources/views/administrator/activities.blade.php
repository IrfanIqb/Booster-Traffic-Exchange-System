@extends('administrator.layouts.master')



@section('content')

    <div id="content" class="app-content" role="main">
        <div class="app-content-body ">

            <div class="bg-light lter b-b wrapper-md">
                <h1 class="m-n font-thin h3">Activities</h1>
            </div>
            <div class="wrapper-md">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Activities
                    </div>
                    <div class="panel-body b-b b-light">
                        {{trans('messages.Search')}}
                        <form action="/administrator/activities" method="post">
                            <input name="search" type="text" class="form-control input-sm w-sm inline m-r"/>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="submit" style="position: absolute; left: -9999px"/>

                        </form>
                    </div>
                    <div>
                        <table class="table m-b-none"  >
                            <thead>
                            <tr>
                                <th data-toggle="true">
                                    ID
                                </th>
                                <th data-toggle="true">
                                    Email
                                </th>
                                <th>
                                    Activity
                                </th>
                                <th >
                                    Link
                                </th>

                            </tr>
                            </thead>
                            @foreach($activities as $activity)
                                <tbody>
                                <tr>
                                    <td>{{$activity->client_id}}</td>
                                    <td>{{$activity->email}}</td>
                                    <td>{{$activity->activity}}</td>
                                    <td>{{$activity->link}}</td>

                                </tr>
                                </tbody>
                            @endforeach

                        </table>

                    </div>
                    <div class="pull-right">
                        {!! $activities->render() !!}
                    </div>
                </div>
            </div>


        </div>
    </div>

@stop