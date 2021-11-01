@extends('administrator.layouts.master')

@section('extra_js')
    <script>
        var password = document.getElementById("password")
                , confirm_password = document.getElementById("confirm_password");

        function validatePassword() {
            if (password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
            } else {
                confirm_password.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>
@stop

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
                                <h1 class="m-n font-thin h1 text-black">{{$site_settings->name}}-{{trans('messages.System Settings')}}</h1>
                                <small class="text-muted">{{trans('messages.System Settings')}}</small>
                            </div>
                        </div>
                    </div>
                    <!-- / main header -->
                    <div class="wrapper-md">
                        <!-- stats -->
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default">
                                    <div class="panel-heading font-bold">{{trans('messages.System Settings')}}</div>
                                    <div class="panel-body">
                                        @if(Session::has('message'))
                                            <p class="alert alert-success">{{ Session::get('message') }}</p>
                                        @endif

                                        <form role="form" method="post" enctype="multipart/form-data" action="/administrator/system">
                                            <div class="form-group">
                                                <label>{{trans('messages.Website Name')}}</label>
                                                <input type="text" name="name" class="form-control"
                                                       placeholder="{{trans('messages.Website Name')}}" required>
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            </div>

                                            <div class="form-group">
                                                <label>{{trans('messages.Website Logo')}}</label>
                                                <input type="file"  name="logo"
                                                       class="form-control" placeholder="{{trans('messages.Website Logo')}}" required
                                                >
                                            </div>

                                            <div class="form-group">
                                                <label>{{trans('messages.Meta Tags')}}</label>
                                                <input type="text"  name="meta"
                                                       class="form-control" placeholder="{{trans('messages.Meta Tags')}}" required
                                                >
                                            </div>

                                            <div class="form-group">
                                                <label>{{trans('messages.Point Value')}}</label>
                                                <input type="number"  step="any" name="point_value"
                                                       class="form-control" placeholder="{{trans('messages.Point Value')}}" required
                                                >
                                            </div>

                                            <div class="form-group">
                                                <label>Sharing Limit</label>
                                                <input type="number"  step="any" name="share_limit"
                                                       class="form-control" placeholder="Sharing Limit" required
                                                >
                                            </div>


                                            <button type="submit" class="btn btn-sm btn-primary">{{trans('messages.Set Settings')}}
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