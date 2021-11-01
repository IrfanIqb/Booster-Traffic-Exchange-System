@extends('administrator.layouts.master')



@section('content')

    <div id="content" class="app-content" role="main">
        <div class="app-content-body ">

            <div class="bg-light lter b-b wrapper-md">
                <h1 class="m-n font-thin h3">{{trans('messages.Withdrawals')}}</h1>
            </div>
            <div class="wrapper-md">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{trans('messages.Withdrawals')}}
                    </div>
                    <div class="panel-body b-b b-light">
                        {{trans('messages.Search')}}: <input id="filter" type="text" class="form-control input-sm w-sm inline m-r"/>
                    </div>
                    <div>
                        <table class="table m-b-none" ui-jq="footable" data-filter="#filter" data-page-size="10">
                            <thead>
                            <tr>
                                <th data-toggle="true">
                                    {{trans('messages.Email')}}
                                </th>
                                <th>
                                    {{trans('messages.Paypal Email')}}
                                </th>
                                <th data-hide="phone,tablet">
                                    {{trans('messages.Points')}}
                                </th>
                                <th data-hide="phone,tablet">
                                    {{trans('messages.Payment')}}
                                </th>
                                <th data-hide="phone,tablet" >
                                    {{trans('messages.Status')}}
                                </th>
                                <th data-hide="phone">
                                    {{trans('messages.Action')}}
                                </th>
                            </tr>
                            </thead>
                            @foreach($withdrawals as $withdrawal)
                                <tbody>
                                <tr>
                                    <td>{{$withdrawal->email}}</td>
                                    <td>{{$withdrawal->paypal_email}}</td>
                                    <td>{{$withdrawal->points}}</td>
                                    <td>{{($withdrawal->points)*($site_settings->point_value)}}$</td>
                                    <td>{{$withdrawal->status}}</td>
                                    <td><a href="/administrator/withdrawal/process/{{$withdrawal->id}}"
                                           class="btn btn-primary btn-sm">{{trans('messages.Paid')}}</a>
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