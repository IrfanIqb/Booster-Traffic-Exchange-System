 <!-- header -->
    <header id="header" class="app-header navbar" role="menu">
        <!-- navbar header -->
        <div class="navbar-header bg-dark">
            <button class="pull-right visible-xs dk" ui-toggle="show" target=".navbar-collapse">
                <i class="glyphicon glyphicon-cog"></i>
            </button>
            <button class="pull-right visible-xs" ui-toggle="off-screen" target=".app-aside" ui-scroll="app">
                <i class="glyphicon glyphicon-align-justify"></i>
            </button>
            <!-- brand -->
            <a href="#/" class="navbar-brand text-lt">
                <img src="/logo.png" alt="." >
                <span class="hidden-folded m-l-xs">{{$site_settings->name}}</span>
            </a>
            <!-- / brand -->
        </div>
        <!-- / navbar header -->

        <!-- navbar collapse -->
        <div class="collapse pos-rlt navbar-collapse box-shadow bg-white-only">
            <!-- buttons -->
            <div class="nav navbar-nav hidden-xs">
                <a href="#" class="btn no-shadow navbar-btn" ui-toggle="app-aside-folded" target=".app">
                    <i class="fa fa-dedent fa-fw text"></i>
                    <i class="fa fa-indent fa-fw text-active"></i>
                </a>
                <a href="/dashboard" class="btn no-shadow navbar-btn" >
                    <i class="icon-home fa-fw"></i>
                </a>
                <a href="/traffic-exchange" class="btn no-shadow navbar-btn" >
                    <i class="icon-shuffle fa-fw"></i>
                </a>
                <a href="/websites" class="btn no-shadow navbar-btn" >
                    <i class="icon-globe fa-fw"></i>
                </a>
                <a href="/referrals" class="btn no-shadow navbar-btn">
                    <i class="icon-user fa-fw"></i>
                </a>
                <a href="/support" class="btn no-shadow navbar-btn">
                    <i class="icon-question fa-fw"></i>
                </a>
                <a href="/settings" class="btn no-shadow navbar-btn">
                    <i class="icon-settings fa-fw"></i>
                </a>
                <a href="/logout" class="btn no-shadow navbar-btn">
                    <i class="icon-logout fa-fw"></i>
                </a>
            </div>
            <!-- / buttons -->


            <!-- nabar right -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
              <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                <i class="on md b-white bottom"></i>
              </span>
                        <span class="hidden-sm hidden-md">{{Auth::user()->name}}</span> <b class="caret"></b>
                    </a>
                    <!-- dropdown -->
                    <ul class="dropdown-menu animated fadeInRight w">

                        <li>
                            <a href="/settings">
                                <span>{{trans('messages.Settings')}}</span>
                            </a>
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a href="/logout">{{trans('messages.Logout')}}</a>
                        </li>
                    </ul>
                    <!-- / dropdown -->
                </li>
            </ul>
            <!-- / navbar right -->
        </div>
        <!-- / navbar collapse -->

    </header>
    <!-- / header -->

