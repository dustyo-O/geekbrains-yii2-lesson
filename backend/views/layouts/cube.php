<?php
/**
 * Created by PhpStorm.
 * User: dusty
 * Date: 26.09.16
 * Time: 19:16
 */
use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\CubeAsset;

CubeAsset::register($this)
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <?= Html::csrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>
</head>
<body class="theme-turquoise">
<div id="theme-wrapper">
    <header class="navbar" id="header-navbar">
        <div class="container">
            <a href="index.html" id="logo" class="navbar-brand">
                <img src="img/logo.png" alt="" class="normal-logo logo-white"/>
                <img src="img/logo-black.png" alt="" class="normal-logo logo-black"/>
                <img src="img/logo-small.png" alt="" class="small-logo hidden-xs hidden-sm hidden"/>
            </a>

            <div class="clearfix">
                <button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="fa fa-bars"></span>
                </button>

                <div class="nav-no-collapse pull-right" id="header-nav">
                    <ul class="nav navbar-nav pull-right">

                        <li class="dropdown profile-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="img/samples/scarlet-159.png" alt=""/>
                                <span class="hidden-xs"><?= Yii::$app->user->identity->username ?></span> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="user-profile.html"><i class="fa fa-user"></i>Profile</a></li>
                                <li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
                                <li><a href="#"><i class="fa fa-envelope-o"></i>Messages</a></li>
                                <li><a href="#"><i class="fa fa-power-off"></i>Logout</a></li>
                            </ul>
                        </li>
                        <li class="hidden-xxs">
                            <a class="btn" href="<?= Url::to(['site/logout']) ?>" data-method="post">
                                <i class="fa fa-power-off"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div id="page-wrapper" class="container">
        <div class="row">
            <div id="nav-col">
                <section id="col-left" class="col-left-nano">
                    <div id="col-left-inner" class="col-left-nano-content">
                        <div id="user-left-box" class="clearfix hidden-sm hidden-xs dropdown profile2-dropdown">
                            <img alt="" src="img/samples/scarlet-159.png" />
                            <div class="user-box">
									<span class="name">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">
											Scarlett J.
											<i class="fa fa-angle-down"></i>
										</a>
										<ul class="dropdown-menu">
											<li><a href="user-profile.html"><i class="fa fa-user"></i>Profile</a></li>
											<li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
											<li><a href="#"><i class="fa fa-envelope-o"></i>Messages</a></li>
											<li><a href="#"><i class="fa fa-power-off"></i>Logout</a></li>
										</ul>
									</span>
                                <span class="status">
										<i class="fa fa-circle"></i> Online
									</span>
                            </div>
                        </div>
                        <div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav">
                            <ul class="nav nav-pills nav-stacked">
                                <li class="nav-header nav-header-first hidden-sm hidden-xs">
                                    Navigation
                                </li>
                                <li>
                                    <a href="index.html">
                                        <i class="fa fa-dashboard"></i>
                                        <span>Dashboard</span>
                                        <span class="label label-primary label-circle pull-right">28</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
                <div id="nav-col-submenu"></div>
            </div>
            <div id="content-wrapper">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="row">
                            <div class="col-lg-12">
                                <ol class="breadcrumb">
                                    <li><a href="#">Home</a></li>
                                    <li class="active"><span>Dashboard</span></li>
                                </ol>

                                <h1>Dashboard</h1>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-box clearfix">
                                    <header class="main-box-header clearfix">
                                        <h2>Box Header</h2>
                                    </header>

                                    <div class="main-box-body clearfix">
                                        <?= $content ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <footer id="footer-bar" class="row">
                    <p id="footer-copyright" class="col-xs-12">
                        Powered by Cube Theme.
                    </p>
                </footer>
            </div>
        </div>
    </div>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
