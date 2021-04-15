<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>LogicMath</title>
        <link href="/template/css/bootstrap.min.css" rel="stylesheet">
        <link href="/template/css/font-awesome.min.css" rel="stylesheet">
<!--        <link href="/template/css/prettyPhoto.css" rel="stylesheet">-->
<!--        <link href="/template/css/price-range.css" rel="stylesheet">-->
<!--        <link href="/template/css/animate.css" rel="stylesheet">-->
        <link href="/template/css/home.css" rel="stylesheet">
        <link href="/template/css/responsive.css" rel="stylesheet">
<!--        <link href="/template/css/style.css" rel="stylesheet">-->
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
        <div class="page-wrapper container-fluid">


            <header id="header"><!--header-->
                <div class="container-fluid hidden-xs">
                    <div class="row">
                        <div class="logo col-sm-2 col-sm-offset-1">
                            <a href="/"><img src="/template/images/home/logo.png" alt=""></a>
                        </div>
                        <div class="col-sm-5 col-sm-offset-3">
                            <div class="row">
                                <div class="col-sm-6 navigation">
                                    <a href="tel:87752317019"><img src="/template/images/home/phone.png" alt="" style="width: 25px">  +7-(775)-231-70-19</a>
                                </div>
                                <div class="col-sm-3 navigation">
                                    <?if (User::isGuest() == true):?>
                                            <a href="/user/register">Тіркелу</a>
                                    <?else:?>
                                            <a href="/cabinet">Тапсырмалар</a>
                                    <?endif;?>
                                </div>
                                <div class="col-sm-3 navigation">
                                    <?if (User::isGuest() == true):?>
                                        <a href="/cabinet">Кіру</a>
                                    <?else:?>
                                        <a href="/user/logout">Шығу</a>
                                    <?endif;?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="visible-xs">
                    <nav class="navbar navbar-default" id="mobMainMenu">
                        <!-- Контейнер (определяет ширину Navbar) -->
                        <div class="container-fluid">
                            <!-- Заголовок -->
                            <div class="navbar-header">
                                <!-- Кнопка «Гамбургер» отображается только в мобильном виде (предназначена для открытия основного содержимого Navbar) -->
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <!-- Бренд или название сайта (отображается в левой части меню) -->
                                <a class="navbar-brand" href="/"><img src="/template/images/home/logo.png" alt=""></a>
                            </div>
                            <!-- Основная часть меню (может содержать ссылки, формы и другие элементы) -->
                            <div class="collapse navbar-collapse" id="navbar-main">
                                <ul class="nav navbar-nav">
                                    <?if (User::isGuest() == true):?>
                                    <li class="<?=$currClass=='register'?'active':'';?>">
                                            <a href="/user/register">Тіркелу</a>
                                    </li>
                                    <?endif;?>
                                    <?if (User::isGuest() == true):?>
                                        <li class="<?=$currClass=='login'?'active':'';?>"><a href="/cabinet">Кіру</a></li>
                                    <?else:?>

                                            <li><a href="/cabinet">Тапсырмалар</a></li>
                                            <li><a href="/user/logout">Шығу</a></li>

                                    <?endif;?>
                                </ul>
                            </div>
                        </div>
                    </nav>

                </div>

            </header><!--/header-->