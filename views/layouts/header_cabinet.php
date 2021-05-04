<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Главная</title>
    <link href="/template/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/css/font-awesome.min.css" rel="stylesheet">
    <!--        <link href="/template/css/prettyPhoto.css" rel="stylesheet">-->
    <!--        <link href="/template/css/price-range.css" rel="stylesheet">-->
    <link href="/template/css/animate.css" rel="stylesheet">
    <link href="/template/css/main.css" rel="stylesheet">
    <link href="/template/css/style.css" rel="stylesheet">
    <link href="/template/css/responsive.css" rel="stylesheet">

<!--    <link rel="stylesheet" href="/template/css/tox-progress.css">-->
    <!--[if lt IE 9]>
<!--    <script src="js/html5shiv.js"></script>-->
<!--    <script src="js/respond.min.js"></script>-->
    <![endif]-->
    <link rel="shortcut icon" href="/template/images/ico/favicon.ico">


</head><!--/head-->

<body>
<div class="page-wrapper" id = "mainPage">


    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container-fluid">
                <div class="row">

                </div>
            </div>
        </div><!--/header_top-->

        <div class="header-middle"><!--header-middle-->
            <div class="container-fluid hidden-xs hidden-sm hidden-md hidden-lg">
                <div class="row">
                    <div id="head">
                    <div class="container" >
<!--                        <div class="row">-->
                        <div class="col-xs-2 " id="myRating">
                            <a href="/cabinet/rating"><img src="/template/images/home/star.png" alt="" width="24"> <span style="color: #fff"><?=$myScore;?></span></i></a>
                        </div>
                        <div class="col-xs-4" id="user">
                            <div class="col-xs-6 ">
                                <a href="/profile">
                                    <span><?=$user['name'];?> </span>
                                    <?$fileName = $_SERVER['DOCUMENT_ROOT'] ."/upload/images/user/".$userId.".jpg"; ?>
                                    <?if(file_exists($fileName)):?>
                                        <img src="/upload/images/user/<?=$userId;?>.jpg" alt="">
                                    <?else:?>
                                        <img src="/upload/images/user/default.png" alt="">
                                    <?endif;?>
                                </a>
                            </div>
                        </div>
                        <!-- <div class="col-xs-1">
                            <div class="logout">
                                <a href="/user/logout/"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                            </div>
                        </div> -->
<!--                        </div>-->
                    </div>
                    </div>
                    
                </div>
            </div>
        </div><!--/header-middle-->

        <div class="header-bottom hidden-xs"><!--header-bottom-->
            <div class="container">

            </div>
        </div><!--/header-bottom-->

    </header><!--/header-->
    <div id="menu" class="hidden-xs">
        <div class="sizeMenu">
        <ul>
            <li  class=""><a href="/">
                    <img src="/template/images/home/logicmath3.png" alt="" class="menu-logo"><br>
                </a>
            </li>
            <li  class="<?=$currClass=='cabinet'?'activ':'';?>"><a href="/cabinet">
                    <img src="/template/images/home/task.png" alt="" class="menu-logo"><br>
                    Тапсырмалар
                </a>
            </li>
            <li class="<?=$currClass=='rating'?'activ':'';?>"><a href="/cabinet/rating">
                    <img src="/template/images/home/rating.png" alt="" class="menu-logo"><br>
                    Рейтинг
                </a>
            </li>
            <li class="<?=$currClass=='progress'?'activ':'';?>">
                <a href="/progress">
                    <img src="/template/images/home/progress.png" alt="" class="menu-logo"><br>
                    Прогресс</a>
            </li>
            <?if (intval($user['role_id']) == 1):?>
                <li>
                    <a href="/admin">
                        <img src="/template/images/home/admin.png" alt="" class="menu-logo"><br>
                        Админ</a>
                </li>
            <?endif;?>
            <li>
                <div>
                    <a href="/user/logout/"><i class="fa fa-sign-out" aria-hidden="true" width='50'></i><br> Шығу</a>
                </div>
            </li>
        </ul>
        </div>
        
    </div>
    <div id="mobileMenu" class="visible-xs">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-3 logicmoblog">
                    <a href="/">
                        <img src="../../template/images/home/logo-mobile-footer.png" alt="" class="menu-logo">
                        
                    </a>
                </div>
                <div class="col-xs-3 p-0 <?=$currClass=='cabinet'?'activ':'';?>">
                    <a href="/cabinet">
                        <img src="../../template/images/home/task.png" alt="" class="menu-logo"><br>
                        Тапсырмалар
                    </a>
                </div>
                <div class="col-xs-3 ratingLogo p-0 <?=$currClass=='rating'?'activ':'';?>">
                    <a href="/cabinet/rating">
                        <img src="../../template/images/home/rating.png" alt="" class="menu-logo"><br>
                        Рейтинг
                    </a>
                </div>
                <div class="col-xs-3 p-0 <?=$currClass=='progress'?'activ':'';?>">
                    <a href="/progress">
                        <img src="../../template/images/home/progress-mobile.png" alt="" class="menu-logo"><br>прогресс
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="mobileHeader" class="visible-xs container">
        <div class="row">
            <div class="col-xs-4">
                <a href="/cabinet/progress">
                    <img src="/template/images/home/molnya.png" alt="">
                    <span>5</span>
                </a>
            </div>
            <div class="col-xs-4">
                <a href="/cabinet/rating">
                    <img src="/template/images/home/star-right.png" alt="" >
                    <span><?=$myScore;?> </span>
                </a>
            </div>
            <div class="col-xs-4">
                <a href="/profile">
                    <?$fileName = $_SERVER['DOCUMENT_ROOT'] ."/upload/images/user/".$userId.".jpg"; ?>
                    <?if(file_exists($fileName)):?>
                        <img class="userPhoto2" src="/upload/images/user/<?=$userId;?>.jpg" alt="">
                    <?else:?>
                        <img class="userPhoto2" src="/upload/images/user/default.png" alt="">
                    <?endif;?>
                    <span><?=$user['name'];?> </span>
                </a>
            </div>


        </div>

    </div>