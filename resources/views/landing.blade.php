<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Add Your favicon here -->
    <!--<link rel="icon" href="img/favicon.ico">-->

    <title>{{$site_settings->name}}</title>

    <!-- Bootstrap core CSS -->
    <link href="/frontend/css/bootstrap.min.css" rel="stylesheet">

    <!-- Animation CSS -->
    <link href="/frontend/css/animate.min.css" rel="stylesheet">

    <link href="/frontend/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="/frontend/css/style.css" rel="stylesheet">
</head>
<body id="page-top">
<div class="navbar-wrapper">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">{{$site_settings->name}}</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="page-scroll" href="#page-top">{{trans('messages.Home')}}</a></li>
                    <li><a class="page-scroll" href="#features">{{trans('messages.Features')}}</a></li>
                    <li><a class="page-scroll" href="/login">{{trans('messages.Login')}}</a></li>
                    <li><a class="page-scroll" href="/register">{{trans('messages.Register')}}</a></li>

                </ul>


            </div>
            <div class="dropdown pull-right">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">{{\Session::get('lang_name', 'English')}}
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="/translate/en/English">English</a></li>
                    <li><a href="/translate/tr/turkish ">Turkish </a></li>
                    <li><a href="/translate/pt/Portuguese ">Portuguese </a></li>
                    <li><a href="/translate/cs/Czech">Czech</a></li>
                    <li><a href="/translate/de/German">German</a></li>
                    <li><a href="/translate/es/Spanish">Spanish</a></li>
                    <li><a href="/translate/fr/French">French</a></li>
                    <li><a href="/translate/ga/Irish">Irish</a></li>
                    <li><a href="/translate/it/Italian">Italian</a></li>
                    <li><a href="/translate/ja/Japanese">Japanese</a></li>
                    <li><a href="/translate/ko/Korean">Korean</a></li>
                    <li><a href="/translate/nl/Dutch">Dutch</a></li>
                    <li><a href="/translate/ur/Urdu">Urdu</a></li>
                    <li><a href="/translate/ar/Arabic">Arabic</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<div id="inSlider" class="carousel carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#inSlider" data-slide-to="0" class="active"></li>
        <li data-target="#inSlider" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <div class="container">
                <div class="carousel-caption">
                    <h2>{{$site_settings->name}} {{trans('messages.is a Traffic Exchange service, ')}} <br> {{trans('messages.which automatically delivers free traffic')}} <br> {{trans('messages.to your website.')}}
                    </h2><br>
                    <p>{{trans('messages.Register to boost your website')}}</p>
                    <p>
                        <a class="btn btn-lg btn-primary" href="/register" role="button">{{trans('messages.Register')}}</a>
                    </p>
                </div>

            </div>
            <!-- Set background for slide in css -->
            <div class="header-back one"></div>

        </div>
        <div class="item">
            <div class="container">
                <div class="carousel-caption blank">
                    <h2> {{trans('messages.Booster includes both')}} <br/> {{trans('messages.automatic and manual exchange')}} </h2><br>
                    <p>{{trans('messages.Register to boost your website')}}</p>
                    <p><a class="btn btn-lg btn-primary" href="/register" role="button">{{trans('messages.Register')}}</a></p>
                </div>
            </div>
            <!-- Set background for slide in css -->
            <div class="header-back two"></div>
        </div>
    </div>
    <a class="left carousel-control" href="#inSlider" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">{{trans('messages.Previous')}}</span>
    </a>
    <a class="right carousel-control" href="#inSlider" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">{{trans('messages.Next')}}</span>
    </a>
</div>


<section id="features" class="container services">
    <div class="row">
        <div class="col-sm-3">
            <h2>{{trans('messages.Fully responsive')}}</h2>
            <p>{{trans('messages.Booster traffic exchange is fully responsive ,works perfectly on each and every device.')}}</p>
        </div>
        <div class="col-sm-3">
            <h2>{{trans('messages.Automatic Traffic Exchange')}}</h2>
            <p>{{trans('messages.Booster traffic exchange has a powerfull traffic session manager which automatically visit other sites')}}</p>
        </div>
        <div class="col-sm-3">
            <h2>{{trans('messages.Manual Traffic Exchange')}}</h2>
            <p>{{trans('messages.Dont want to wait , Then do it manually , Booster also includes manual exchange system')}} </p>
        </div>
        <div class="col-sm-3">
            <h2>{{trans('messages.Social Exchange')}}</h2>
            <p>{{trans('messages.Social Exchange awards the points on sharing social content')}} </p>
        </div>
    </div>
</section>

<section  class="container features">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="navy-line"></div>
            <h1>{{trans('messages.Over Exciting features')}}<br/> <span class="navy"> {{trans('messages.with many custom components')}}</span> </h1>
            <p>{{trans('messages.Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.')}} </p>

        </div>
    </div>
    <div class="row">
        <div class="col-md-3 text-center wow fadeInLeft">
            <div>
                <i class="fa fa-upload features-icon"></i>
                <h2>{{trans('messages.Upload your website')}}</h2>
                <p>{{trans('messages.Submit your website using the websites and start getting automatic hits on it')}}</p>
            </div>
            <div class="m-t-lg">
                <i class="fa fa-bar-chart features-icon"></i>
                <h2>{{trans('messages.Traffic Exchange')}}</h2>
                <p>{{trans('messages.Start a regular browser session in order to visit other sites and earn points')}}</p>
            </div>
        </div>
        <div class="col-md-6 text-center  wow zoomIn">
            <img src="/frontend/img/perspective.PNG" alt="dashboard" class="img-responsive">
        </div>
        <div class="col-md-3 text-center wow fadeInRight">
            <div>
                <i class="fa fa-line-chart features-icon"></i>
                <h2>{{trans('messages.Increase alexa rank')}}</h2>
                <p>{{trans('messages.Earn more points or purchase them to get more points and boost your alexa rank')}}</p>
            </div>
            <div class="m-t-lg">
                <i class="fa fa-briefcase features-icon"></i>
                <h2>{{trans('messages.Earn Revenue')}}</h2>
                <p>{{trans('messages.You can also earn revenue by visiting users sites by converting points into earnings')}}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="navy-line"></div>
            <h1>{{trans('messages.Discover great features')}}</h1>
            <p>{{trans('messages.Booster traffic exchange is one of the best selling traffic exchange script on codecanyon')}}</p>
        </div>
    </div>
    <div class="row features-block">
        <div class="col-lg-6 features-text wow fadeInLeft">
            <small>{{trans('messages.BOOSTER')}}</small>
            <h2> {{trans('messages.Perfectly designed')}}</h2>
            <p>{{trans('messages.BOOSTER traffic exchange is a premium traffic exchange script with a clean and responsive design')}} </p>
        </div>
        <div class="col-lg-6 text-right wow fadeInRight">
            <img src="/frontend/img/dashboard.png" alt="dashboard" class="img-responsive pull-right">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg">
            <p><strong>&copy; {{trans('messages.2015 Company Name')}}</strong><br/> {{trans('messages.consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.')}}</p>
        </div>
    </div>
</section>




<script src="/frontend/js/jquery-2.1.1.js"></script>
<script src="/frontend/js/pace.min.js"></script>
<script src="/frontend/js/bootstrap.min.js"></script>
<script src="/frontend/js/classie.js"></script>
<script src="/frontend/js/cbpAnimatedHeader.js"></script>
<script src="/frontend/js/wow.min.js"></script>
<script src="/frontend/js/inspinia.js"></script>
</body>
</html>
