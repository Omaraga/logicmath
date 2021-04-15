<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Профиль</title>
        <link href="/template/css/bootstrap.min.css" rel="stylesheet">
        <link href="/template/css/font-awesome.min.css" rel="stylesheet">
<!--        <link href="/template/css/prettyPhoto.css" rel="stylesheet">-->
<!--        <link href="/template/css/price-range.css" rel="stylesheet">-->
        <link href="/template/css/animate.css" rel="stylesheet">
        <link href="/template/css/main.css" rel="stylesheet">
        <link href="/template/css/style.css" rel="stylesheet">
        <link href="/template/css/responsive.css" rel="stylesheet">

        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->       
        <link rel="shortcut icon" href="/template/images/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/template/images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/template/images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/template/images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="/template/images/ico/apple-touch-icon-57-precomposed.png">
    </head><!--/head-->

    <body>
        <div class="page-wrapper" id = "userPage">


            <header id="header"><!--header-->
                <div class="header_top"><!--header_top-->
                    <div class="container-fluid">
                        <div class="row">

                        </div>
                    </div>
                </div><!--/header_top-->

                <div class="header-middle"><!--header-middle-->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="logo pull-left">
                                    <!--<a href="/"><img src="/template/images/home/logo.png" alt="" /></a>-->
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="shop-menu pull-right">
                                    <ul class="nav navbar-nav">

                                        <?php if (User::isGuest()): ?>                                        
                                            <li><a href="/user/login/"><i class="fa fa-lock"></i> Вход</a></li>
                                        <?php else: ?>
                                            <li><a href="/profile"><i class="fa fa-user"></i> Аккаунт</a></li>
                                            <li><a href="/user/logout/"><i class="fa fa-unlock"></i> Выход</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/header-middle-->

                <div class="header-bottom"><!--header-bottom-->
                    <div class="container">

                    </div>
                </div><!--/header-bottom-->

            </header><!--/header-->
            <div id="menu">
                <ul>
                    <li  class="<?=$currClass=='cabinet'?'activ':'';?>"><a href="/cabinet">
                            <img src="../../template/images/home/task.png" alt="" class="menu-logo"><br>
                            Задачи
                        </a>
                    </li>
                    <li class="<?=$currClass=='rating'?'activ':'';?>"><a href="/cabinet/rating/1">
                        <img src="../../template/images/home/rating.png" alt="" class="menu-logo"><br>
                        Рейтинг
                        </a>
                    </li>
                    <li class="<?=$currClass=='help'?'activ':'';?>">
                        <a href="/cabinet/help">
                        <img src="../../template/images/home/spravochnik.png" alt="" class="menu-logo"><br>
                        Советы</a>
                    </li>
                </ul>
            </div>