@extends('layouts.master')

@section('extra_js')

    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script>
        var handler = StripeCheckout.configure({
            key: '{{env('STRIPE_API_KEY')}}',
            image: '/logo.ico',
            locale: 'auto',
            token: function (token) {
                console.log(token);
                // Use the token to create the charge with a server-side script.
                // You can access the token ID with `token.id`
                getSession(token.id);
            }
        });

        $('#customButton').on('click', function (e) {
            // Open Checkout with further options
            handler.open({
                name: 'Booster',
                description: 'You will be charged {{$memberships->amount}} $',
                amount: '{{($memberships->amount)*100}}'
            });
            e.preventDefault();

        });

        // Close Checkout on page navigation
        $(window).on('popstate', function () {
            handler.close();
        });

        function getSession(token) {
            $.ajax({
                'type': 'GET',
                'url': '/api/stripe?stripeToken=' + token
            });
            alert("Payment Successfully Done");
        }
    </script>

@stop

@section('content')


    <div id="content" class="app-content" role="main">
        <div class="app-content-body ">


            <div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="
    app.settings.asideFolded = false;
    app.settings.asideDock = false;
  ">
                <!-- main -->
                <div class="col">
                    <!-- main header -->
                    <div class="bg-light lter b-b wrapper-md">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <h1 class="m-n font-thin h1 text-black">{{$site_settings->name}}-{{trans('messages.Subscriptions')}}</h1>
                                <small class="text-muted">{{trans('messages.Subscriptions')}}</small>
                            </div>
                        </div>
                    </div>
                    <!-- / main header -->
                    <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">
                        <!-- stats -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row row-sm text-center">

                                    <div class="col-xs-12">
                                        <div class="panel padder-v item">
                                            <span class="h3  font-thin h3">{{trans('messages.Membership Features')}}</span>

                                            <div class="h1 text-info font-thin h1">{{isset($memberships->amount)?$memberships->amount:''}}
                                                $
                                            </div>
                                            <span class="text-muted text-xs">{{trans('messages.UNLIMITED SITES')}}</span><br><br>
                                            <span class="text-muted text-xs">{{trans('messages.100% EARNING RATIO')}}</span><br><br>
                                            <span class="text-muted text-xs">{{trans('messages.NO COMMISSION')}}</span><br><br>
                                            <span class="text-muted text-xs">{{trans('messages.FREE SUPPORT')}}</span><br><br>
                                            @if(Auth::user()->membership == 'paid')
                                                <a style="width:60%" class="btn btn-lg btn-primary"><i
                                                            class="fa fa-angle-double-up"></i>{{trans('messages.You are already a premium
                                                   member')}}</a>                                                <i
                                                        class=" text-warning m-r-sm"></i>
                                            @else
                                                @if($control_settings->stripe == "enable")

                                                <a id="customButton" style="width:30%" class="btn btn-lg btn-primary"><i
                                                            class="fa fa-angle-double-up"></i>{{trans('messages.Pay With Stripe')}}</a>
                                                <i class=" text-warning m-r-sm"></i>

                                                @endif

                                                    @if($control_settings->paypal == "enable")

                                                    <a href="/membership/{{$memberships->amount}}" style="width:30%"
                                                   class="btn btn-lg btn-primary"><i
                                                            class="fa fa-angle-double-up"></i>{{trans('messages.Pay With Paypal')}}</a>
                                                <i class=" text-warning m-r-sm"></i>

                                                        @endif



                                            @endif
                                        </div>
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