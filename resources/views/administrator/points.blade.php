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
                                <h1 class="m-n font-thin h1 text-black">{{$site_settings->name}}-{{trans('messages.Points')}} {{trans('messages.Settings')}}</h1>
                                <small class="text-muted">{{trans('messages.Points')}} {{trans('messages.Settings')}}</small>
                            </div>
                        </div>
                    </div>
                    <!-- / main header -->
                    <div class="wrapper-md">
                        <!-- stats -->
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default">
                                    <div class="panel-heading font-bold">{{trans('messages.Points')}} {{trans('messages.Settings')}}</div>
                                    <div class="panel-body">
                                        @if(Session::has('message'))
                                            <p class="alert alert-success">{{ Session::get('message') }}</p>
                                        @endif

                                        <form role="form" method="post" action="/administrator/points">
                                            <div class="form-group">
                                                <label>{{trans('messages.Amount')}}</label>
                                                <input type="number" name="amount" class="form-control"
                                                       placeholder="{{trans('messages.Enter Amount')}}" required>
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            </div>

                                            <div class="form-group">
                                                <label>{{trans('messages.Points')}}</label>
                                                <input type="number"  name="points"
                                                       class="form-control" placeholder="Enter Points{{trans('messages.Enter Points')}}" required
                                                >
                                            </div>

                                            <div class="form-group">
                                                <label>{{trans('messages.Type')}}</label><br>
                                                <select name="type" required>
                                                    <option value="basic">{{trans('messages.Basic')}}</option>
                                                    <option value="premium">{{trans('messages.Premium')}}</option>
                                                    <option value="professional">{{trans('messages.Professional')}}</option>
                                                    <option value="gold">Gold{{trans('messages.Gold')}}</option>
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-sm btn-primary">{{trans('messages.Set Package')}}
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