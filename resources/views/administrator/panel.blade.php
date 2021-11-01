@extends('administrator.layouts.master')



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
                                <h1 class="m-n font-thin h1 text-black">{{$site_settings->name}}-Control Panel</h1>
                                <small class="text-muted">Control Panel</small>
                            </div>
                        </div>
                    </div>
                    <!-- / main header -->
                    <div class="wrapper-md">
                        <!-- stats -->
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default">
                                    <div class="panel-heading font-bold">Control Panel</div>
                                    <div class="panel-body">
                                        @if(Session::has('message'))
                                            <p class="alert alert-success">{{ Session::get('message') }}</p>
                                        @endif

                                        <form role="form" method="post" action="/administrator/panel">

                                            <div class="form-group">
                                                <label>Traffic Exchange System</label><br>
                                                <select name="traffic_exchange" style="width: 700px" required>

                                                    <option value="enable">Enable</option>
                                                    <option value="disable">Disable</option>
                                                </select>
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">

                                            </div>

                                            <div class="form-group">
                                                <label>Manual Exchange System</label><br>
                                                <select name="manual_exchange" style="width: 700px" required>
                                                    <option value="enable">Enable</option>
                                                    <option value="disable">Disable</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Social Exchange System</label><br>
                                                <select name="social_exchange" style="width: 700px" required>
                                                    <option value="enable">Enable</option>
                                                    <option value="disable">Disable</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Media Exchange System</label><br>
                                                <select name="media_exchange" style="width: 700px" required>
                                                    <option value="enable">Enable</option>
                                                    <option value="disable">Disable</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Referral System</label><br>
                                                <select name="referral" style="width: 700px" required>
                                                    <option value="enable">Enable</option>
                                                    <option value="disable">Disable</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Paypal Payment Gateway</label><br>
                                                <select name="paypal" style="width: 700px" required>
                                                    <option value="enable">Enable</option>
                                                    <option value="disable">Disable</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Stripe Payment Gateway</label><br>
                                                <select name="stripe" style="width: 700px" required>
                                                    <option value="enable">Enable</option>
                                                    <option value="disable">Disable</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Points Management System</label><br>
                                                <select name="points" style="width: 700px" required>
                                                    <option value="enable">Enable</option>
                                                    <option value="disable">Disable</option>
                                                </select>
                                            </div>

                                            <button type="submit" style="width: 700px" class="btn btn-sm btn-primary">Update
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