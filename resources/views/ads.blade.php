
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

    <title>Booster</title>

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


        </div>
    </nav>
</div>


<section id="features" class="container services">
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
            <div class="ad728-wrapper">
                <div class="ad728-wrapper">
                    <a href="#">
                        <img src="http://159.89.172.214/assets/img/ban728.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section  class="container features">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="navy-line"></div>
            <h3 id="hello">Please wait for <span id="count">5</span> secs</h3>
           <a href="{{$website->website}}"><button type="button" class="btn-primary" id="proceed"  style="display: none;">Go to Link</button></a>


        </div>
    </div>
    <div class="row">
        <div class="col-md-6 text-center wow fadeInLeft">
            <div>
                <i class="fa fa-upload features-icon"></i>
                <h2>Upload your website</h2>
                <p>Submit your website for earning points and converting those points into cash </p>
            </div>
            <div class="m-t-lg">
                <i class="fa fa-bar-chart features-icon"></i>
                <h2>Referrals</h2>
                <p>Earn Points By Referring Others</p>
            </div>
        </div>

        <div class="col-md-6 text-center wow fadeInRight">
            <div>
                <i class="fa fa-line-chart features-icon"></i>
                <h2>Subscription Module</h2>
                <p>A Free User Can Add Limited No of Sites , While a Premium Member can Add Unlimited Sites</p>
            </div>
            <div class="m-t-lg">
                <i class="fa fa-briefcase features-icon"></i>
                <h2>Transfers </h2>
                <p>One User Can Transfer Points To other User</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg">
            <p><strong>&copy; 2015 Company Name</strong><br/> consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
        </div>
    </div>
</section>



<script src="/libs/jquery/jquery/dist/jquery.js"></script>
<script>

    window.onload = function(){

        (function(){
            var counter = 5;

            setInterval(function() {
                counter--;
                if (counter >= 0) {
                    span = document.getElementById("count");
                    span.innerHTML = counter;
                }
                // Display 'counter' wherever you want to display it.
                if (counter === 0) {
                    $.ajax({
                        'url': '/api/short_links',
                        data: {
                            "client_id": "{{$website->client_id}}"
                        },
                        'type': 'GET',
                        'success': function (response) {
                            clearInterval(counter);
                            return true;
                        },
                        'error': function (response) {
                            return false;
                        }
                    });


                }

            }, 1000);

        })();

    }
</script>
<script src="/frontend/js/jquery-2.1.1.js"></script>
<script src="/frontend/js/pace.min.js"></script>
<script src="/frontend/js/bootstrap.min.js"></script>
<script src="/frontend/js/classie.js"></script>
<script src="/frontend/js/cbpAnimatedHeader.js"></script>
<script src="/frontend/js/wow.min.js"></script>
<script src="/frontend/js/inspinia.js"></script>
<script type="text/javascript">
    $('#proceed').delay(5000).show(0);
</script>
</body>
</html>
