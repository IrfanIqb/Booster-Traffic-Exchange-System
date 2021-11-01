@extends('administrator.layouts.master')

@section('extra_js')
    <script>
        var password = document.getElementById("password")
                , confirm_password = document.getElementById("confirm_password");

        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }

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
                                <h1 class="m-n font-thin h1 text-black">{{$site_settings->name}}-{{trans('messages.Edit User')}}</h1>
                                <small class="text-muted">{{trans('messages.Edit User')}}</small>
                            </div>
                        </div>
                    </div>
                    <!-- / main header -->
                    <div class="wrapper-md">
                        <!-- stats -->
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default">
                                    <div class="panel-heading font-bold">{{trans('messages.Edit User')}}</div>
                                    <div class="panel-body">
                                        @if(Session::has('success_msg'))
                                            <p class="alert alert-success">{{ Session::get('success_msg') }}</p>
                                        @endif
                                        @if(Session::has('error_msg'))
                                            <p class="alert alert-danger">{{ Session::get('error_msg') }}</p>
                                        @endif
                                        <form role="form" method="post" action="/administrator/edit/{{$user->id}}">
                                            <div class="form-group">
                                                <label>{{trans('messages.Points')}}</label>
                                                <input type="number" name="points" class="form-control"
                                                       placeholder="{{trans('messages.Enter Points')}}" value="{{$user->points}}" required>
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            </div>

                                            <div class="form-group">
                                                <label>{{trans('messages.Membership Type')}}</label><br>
                                                <select name="type" required>
                                                    <option value="free">{{trans('messages.Free')}}</option>
                                                    <option value="paid">{{trans('messages.Premium')}}</option>
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-sm btn-primary">{{trans('messages.Update User')}}
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