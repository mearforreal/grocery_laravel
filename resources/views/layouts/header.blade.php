<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Grocery Online</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <script src="https://kit.fontawesome.com/b06817bd37.js" crossorigin="anonymous"></script>
</head><!--/head-->

<body>
<header id="header"><!--header-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="index.html"><img src="images/home/grocery_logo.png" width="139px" height="80px" alt="" /></a>
                    </div>
                    <div class="btn-group pull-right">
                        <div class="btn-group">
                            {{--                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">--}}
                            {{--                                USA--}}
                            {{--                                <span class="caret"></span>--}}
                            {{--                            </button>--}}
                            {{--                            <ul class="dropdown-menu">--}}
                            {{--                                <li><a href="">Canada</a></li>--}}
                            {{--                                <li><a href="">UK</a></li>--}}
                            {{--                            </ul>--}}
                        </div>

                        <div class="btn-group">
                            {{--                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">--}}
                            {{--                                DOLLAR--}}
                            {{--                                <span class="caret"></span>--}}
                            {{--                            </button>--}}
                            {{--                            <ul class="dropdown-menu">--}}
                            {{--                                <li><a href="">Canadian Dollar</a></li>--}}
                            {{--                                <li><a href="">Pound</a></li>--}}
                            {{--                            </ul>--}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{route('cartproducts')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                            @if(Route::has('login'))
                                @auth
                                    @if(Auth::user()->utype === "ADM")
                                        <li><a href=""><i class="fa fa-user"></i>My account({{Auth::user()->name}})</a></li>
                                        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-star"></i> {{Auth::user()->utype}} Dashboard</a></li>

                                        {{--                                        <li><a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out></i> Logout</a></li>--}}
                                        <li>
                                            <a href="{{route('logout')}}"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out"></i>Logout</a>
                                        </li>
                                        <form action="{{route('logout')}}" id="logout-form" method="post">
                                            @csrf
                                        </form>



                                    @else
                                        <li><a href="#"><i class="fa fa-user"></i>My account({{Auth::user()->name}})</a></li>
                                        <li><a href="{{route('user.dashboard')}}"><i class="fa fa-star"></i> Dashboard</a></li>


                                        <li>
                                            <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out"></i></a>
                                        </li>
                                        <form action="{{route('logout')}}" id="logout-form" method="post">
                                            @csrf
                                        </form>

                                    @endif



                                @else
                                    <li><a href="{{route('login')}}" class="active"><i class="fa fa-lock"></i> Login</a></li>
                                    <li><a href="{{route('register')}}" class="active"><i class="fa fa-lock"></i> Register</a></li>
                                @endif

                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->
</header>
