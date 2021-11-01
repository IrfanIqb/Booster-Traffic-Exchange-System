@extends('administrator.layouts.master')



@section('content')

    <div id="content" class="app-content" role="main">
        <div class="app-content-body ">

            <div class="bg-light lter b-b wrapper-md">
                <h1 class="m-n font-thin h3">Transfers</h1>
            </div>
            <div class="wrapper-md">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Transfers
                    </div>
                    <div class="panel-body b-b b-light">
                        {{trans('messages.Search')}}: <input id="filter" type="text" class="form-control input-sm w-sm inline m-r"/>
                    </div>
                    <div>
                        <table class="table m-b-none" ui-jq="footable" data-filter="#filter" data-page-size="10">
                            <thead>
                            <tr>
                                <th data-toggle="true">
                                    From Email
                                </th>
                                <th>
                                    To Email
                                </th>
                                <th >
                                    Points Transferred
                                </th>

                            </tr>
                            </thead>
                            @foreach($transfers as $transfer)
                                <tbody>
                                <tr>
                                    <td>{{$transfer->from}}</td>
                                    <td>{{$transfer->to}}</td>
                                    <td>{{$transfer->amount}}</td>

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