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
                                <h1 class="m-n font-thin h1 text-black">{{$site_settings->name}}-Emailing</h1>
                                <small class="text-muted">Emailing</small>
                            </div>
                        </div>
                    </div>
                    <!-- / main header -->
                    <div class="wrapper-md">
                        <!-- stats -->
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default">
                                    <div class="panel-heading font-bold">Emailing</div>
                                    <div class="panel-body">
                                        @if(Session::has('message'))
                                            <p class="alert alert-success">{{ Session::get('message') }}</p>
                                        @endif

                                        <form role="form" method="post" action="/administrator/emailing">
                                            <div class="form-group">
                                                <label>SUBJECT</label>
                                                <input type="text" name="subject" class="form-control"
                                                      required>
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            </div>

                                            <div class="form-group">
                                                <label>Message</label>


                                                <textarea name="message" class="form-control" >Enter Message Here...</textarea>

                                            </div>



                                            <button type="submit" class="btn btn-sm btn-primary">Send
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