@extends('administrator.layouts.master')



@section('content')

    <div id="content" class="app-content" role="main">
        <div class="app-content-body ">

            <div class="bg-light lter b-b wrapper-md">
                <h1 class="m-n font-thin h3">{{trans('messages.Users')}}</h1>
            </div>
            <div class="wrapper-md">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{trans('messages.Users')}}
                    </div>
                    <div class="panel-body b-b b-light">
                        {{trans('messages.Search')}}: <input id="filter" type="text" class="form-control input-sm w-sm inline m-r"/>
                    </div>
                    <div>
                        <table class="table m-b-none"  ui-jq="footable"  data-filter="#filter" data-page-size="10">
                            <thead>
                            <tr>
                                <th data-toggle="true">
                                    {{trans('messages.Name')}}
                                </th>
                                <th>
                                    {{trans('messages.Email')}}
                                </th>
                                <th data-hide="phone,tablet">
                                    {{trans('messages.Points')}}
                                </th>
                                <th data-hide="phone,tablet" >
                                    {{trans('messages.Membership Type')}}
                                </th>
                                <th data-hide="phone">
                                    {{trans('messages.Edit')}}
                                </th>
                                <th data-hide="phone">
                                    {{trans('messages.Action')}}
                                </th>
                            </tr>
                            </thead>
                            @foreach($users as $user)
                                <tbody>
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->points}}</td>
                                    <td>{{$user->membership}}</td>
                                    <td><a href="/administrator/account/edit/{{$user->id}}"
                                           class="btn btn-primary btn-sm">{{trans('messages.Edit')}}</a>
                                    </td>
                                    <td><a href="/administrator/account/delete/{{$user->id}}"
                                           class="btn btn-danger btn-sm">{{trans('messages.Delete')}}</a>
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                            <tfoot class="hide-if-no-paging">
                            <tr>
                                <td colspan="5" class="text-center">
                                    <ul class="pagination"></ul>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>




        </div>
    </div>

@stop
