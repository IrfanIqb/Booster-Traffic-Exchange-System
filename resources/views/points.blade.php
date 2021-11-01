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

        $('.stripe').on('click', function (e) {

            global_val = $(this).data('value');
            points_val = $(this).data('points');


            // Open Checkout with further options
            handler.open({
                name: 'Booster',
                description: 'You will be charged ' + global_val / 100 + '$',
                amount: global_val
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
                'url': '/api/points?stripeToken=' + token + '&amount=' + global_val + '&points=' + points_val
            });
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
                                <h1 class="m-n font-thin h1 text-black">{{$site_settings->name}}-{{trans('messages.Purchase Points')}}</h1>
                                <small class="text-muted">{{trans('messages.Purchase Points')}}</small>
                            </div>
                        </div>
                    </div>
                    <!-- / main header -->
                    <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">

                        <div class="row no-gutter">
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="panel b-a">
                                    <div class="panel-heading wrapper-xs bg-primary no-border">
                                    </div>
                                    <div class="wrapper text-center b-b b-light">
                                        <h4 class="text-u-c m-b-none">{{trans('messages.Basic')}}</h4>

                                        <h2 class="m-t-none">
                                            <sup class="pos-rlt" style="top:-22px">$</sup>
                                            <span class="text-2x text-lt">{{isset($basic->amount)?$basic->amount:''}}</span>
                                        </h2>
                                    </div>
                                    <ul class="list-group text-center no-borders m-t-sm">
                                        <li class="list-group-item">
                                            <i class="icon-check text-success m-r-xs"></i> {{isset($basic->points)?$basic->points:''}}
                                            points
                                        </li>
                                        <li class="list-group-item">
                                            <i class="icon-check text-success m-r-xs"></i>
                                            Upto {{isset($basic->points)?$basic->points:''}} hits
                                        </li>
                                        <li class="list-group-item">
                                            <i class="icon-check text-success m-r-xs"></i> {{(isset($basic->points)?$basic->points:'')/(isset($basic->amount)?$basic->amount:'1')}}
                                            hits/$
                                        </li>

                                    </ul>
                                    <div class="panel-footer text-center">
                                        @if($control_settings->stripe == "enable")

                                        <a data-value="{{(isset($basic->amount)?$basic->amount:'')*100}}"
                                           data-points="{{isset($basic->points)?$basic->points:''}}"
                                           class="stripe btn btn-primary font-bold m">{{trans('messages.Pay With Stripe')}}</a>
                                       @endif

                                            @if($control_settings->paypal == "enable")

                                            <a href="/payment/{{isset($basic->amount)?$basic->amount:''}}"
                                           class="btn btn-md btn-primary font-bold m"> {{trans('messages.Pay With Paypal')}}</a>

                                                @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="panel b-a m-t-n-md m-b-xl">
                                    <div class="panel-heading wrapper-xs bg-warning dker no-border">

                                    </div>
                                    <div class="wrapper bg-warning text-center m-l-n-xxs m-r-n-xxs">
                                        <h4 class="text-u-c m-b-none">{{trans('messages.Professional')}}</h4>

                                        <h2 class="m-t-none">
                                            <sup class="pos-rlt" style="top:-22px">$</sup>
                                            <span class="text-2x text-lt">{{isset($professional->amount)?$professional->amount:''}}</span>
                                        </h2>
                                    </div>
                                    <ul class="list-group text-center no-borders m-t-sm">
                                        <li class="list-group-item">
                                            <i class="icon-check text-success m-r-xs"></i> {{isset($professional->points)?$professional->points:''}}
                                            points
                                        </li>
                                        <li class="list-group-item">
                                            <i class="icon-check text-success m-r-xs"></i>
                                            Upto {{isset($professional->points)?$professional->points:''}} hits
                                        </li>
                                        <li class="list-group-item">
                                            <i class="icon-check text-success m-r-xs"></i> {{ceil((isset($professional->points)?$professional->points:'')/(isset($professional->amount)?$professional->amount:'1'))}}
                                            hits/$
                                        </li>

                                    </ul>
                                    <div class="panel-footer text-center b-t m-t bg-light lter">
                                        <div class="m-t-sm">Recommanded for you</div>
                                        @if($control_settings->stripe == "enable")

                                        <a data-value="{{(isset($professional->amount)?$professional->amount:'')*100}}"
                                           data-points="{{isset($professional->points)?$professional->points:''}}"
                                           class="stripe btn btn-warning font-bold m">{{trans('messages.Pay With Stripe')}}</a>
                                        @endif

                                        @if($control_settings->paypal == "enable")


                                        <a href="/payment/{{isset($professional->amount)?$professional->amount:''}}"
                                           class="btn btn-md btn-primary font-bold m"> {{trans('messages.Pay With Paypal')}}</a>

                                            @endif


                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="panel b-a">
                                    <div class="panel-heading wrapper-xs bg-primary no-border">
                                    </div>
                                    <div class="wrapper text-center b-b b-light">
                                        <h4 class="text-u-c m-b-none">{{trans('messages.Premium')}}</h4>

                                        <h2 class="m-t-none">
                                            <sup class="pos-rlt" style="top:-22px">$</sup>
                                            <span class="text-2x text-lt">{{isset($premium->amount)?$premium->amount:''}}</span>
                                        </h2>
                                    </div>
                                    <ul class="list-group text-center no-borders m-t-sm">
                                        <li class="list-group-item">
                                            <i class="icon-check text-success m-r-xs"></i> {{isset($premium->points)?$premium->points:''}}
                                            points
                                        </li>
                                        <li class="list-group-item">
                                            <i class="icon-check text-success m-r-xs"></i>
                                            Upto {{isset($premium->points)?$premium->points:''}} hits
                                        </li>
                                        <li class="list-group-item">
                                            <i class="icon-check text-success m-r-xs"></i> {{ceil((isset($premium->points)?$premium->points:'')/(isset($premium->amount)?$premium->amount:'1'))}}
                                            hits/$
                                        </li>

                                    </ul>
                                    <div class="panel-footer text-center">
                                        @if($control_settings->stripe == "enable")

                                        <a data-value="{{(isset($premium->amount)?$premium->amount:'')*100}}"
                                           data-points="{{isset($premium->points)?$premium->points:''}}"
                                           class="stripe btn btn-primary font-bold m">{{trans('messages.Pay With Stripe')}}</a>
                                       @endif

                                            @if($control_settings->paypal == "enable")

                                            <a href="/payment/{{isset($premium->amount)?$premium->amount:''}}"
                                           class="btn btn-md btn-primary font-bold m"> {{trans('messages.Pay With Paypal')}}</a>
                                           @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 hidden-md">
                                <div class="panel b-a">
                                    <div class="panel-heading wrapper-xs bg-primary no-border">
                                    </div>
                                    <div class="wrapper text-center b-b b-light">
                                        <h4 class="text-u-c m-b-none">{{trans('messages.Gold')}}</h4>

                                        <h2 class="m-t-none">
                                            <sup class="pos-rlt" style="top:-22px">$</sup>
                                            <span class="text-2x text-lt">{{isset($gold->amount)?$gold->amount:''}}</span>
                                        </h2>
                                    </div>
                                    <ul class="list-group text-center no-borders m-t-sm">
                                        <li class="list-group-item">
                                            <i class="icon-check text-success m-r-xs"></i> {{isset($gold->points)?$gold->points:''}}
                                            points
                                        </li>
                                        <li class="list-group-item">
                                            <i class="icon-check text-success m-r-xs"></i>
                                            Upto {{isset($gold->points)?$gold->points:''}} hits
                                        </li>
                                        <li class="list-group-item">
                                            <i class="icon-check text-success m-r-xs"></i> {{ceil((isset($gold->points)?$gold->points:'')/(isset($gold->amount)?$gold->amount:'1'))}}
                                            hits/$
                                        </li>

                                    </ul>
                                    <div class="panel-footer text-center">
                                        @if($control_settings->stripe == "enable")

                                        <a data-value="{{(isset($gold->amount)?$gold->amount:'')*100}}"
                                           data-points="{{isset($gold->points)?$gold->points:''}}"
                                           class="stripe btn btn-primary font-bold m">{{trans('messages.Pay With Stripe')}}</a>
                                        @endif

                                            @if($control_settings->paypal == "enable")


                                            <a href="/payment/{{isset($gold->amount)?$gold->amount:''}}"
                                           class="btn btn-md btn-primary font-bold m"> {{trans('messages.Pay With Paypal')}}</a>
                                                  @endif
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