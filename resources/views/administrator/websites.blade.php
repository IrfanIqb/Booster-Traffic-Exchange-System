@extends('administrator.layouts.master')



@section('content')

    <div id="content" class="app-content" role="main">
        <div class="app-content-body ">
            <div class="bg-light lter b-b wrapper-md">
                <h1 class="m-n font-thin h3">{{trans('messages.Websites')}}</h1>
            </div>
            <div class="wrapper-md">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{trans('messages.Websites')}}
                    </div>
                    <div class="panel-body b-b b-light">
                        {{trans('messages.Search')}}: <input id="filter" type="text" class="form-control input-sm w-sm inline m-r"/>
                    </div>
                    <div>
                        <table class="table m-b-none" ui-jq="footable"  data-page-size="10">
                            <thead>
                            <tr>
                                <th data-toggle="true">
                                    {{trans('messages.Id')}}
                                </th>
                                <th>
                                    {{trans('messages.Website')}}
                                </th>
                                <th data-hide="phone,tablet">
                                    {{trans('messages.Status')}}
                                </th>
                                <th data-hide="phone,tablet">
                                    {{trans('messages.Action')}}
                                </th>

                            </tr>
                            </thead>
                            @foreach($websites as $website)
                                <tbody>
                                <tr>
                                    <td>{{$website->id}}</td>
                                    <td>{{$website->website}}</td>
                                    <td><a href="/administrator/website/status/{{$website->id}}"
                                           class="btn btn-primary btn-sm">@if($website->status == 0) Enable @else Disable @endif</a>
                                    </td>
                                    <td><a href="/administrator/website/delete/{{$website->id}}"  class="btn btn-danger btn-sm">{{trans('messages.Delete')}}</a></td>

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