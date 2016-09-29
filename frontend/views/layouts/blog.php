<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\BlogAsset;
use yii\helpers\Html;
use common\models\Aneks;


BlogAsset::register($this);


?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>

</head>

<body>
<?php $this->beginBody() ?>
<div class="navbar navbar-material-blog navbar-primary navbar-absolute-top">

    <div class="navbar-image" style="background-image: url('img/technology/unsplash-6.jpg');background-position: center 40%;"></div>

    <div class="navbar-wrapper container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><i class="material-icons">&#xE871;</i> Анекдоты</a>
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse">
            <ul class="nav navbar-nav">
                <li class="active dropdown">
                    <a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Категории <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php
                        foreach (Aneks::$categories as $cat)
                        {
                            $title = $cat['title'];
                            $cat_id = $cat['id'];
                            ?>
                            <li><a href="<?= \yii\helpers\Url::to(['anek/feed', 'cat' => $cat_id]) ?>"><?= $title ?></a></li>
                        <?php
                        }
                        ?>


                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (Yii::$app->user->isGuest)
                {
                    ?>
                    <li class="active dropdown">
                        <a href="#" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Привет, Гость! <b class="caret"></b></a>
                        <ul class="dropdown-menu">

                            <li><a href="<?= \yii\helpers\Url::to(['user/signup']) ?>">Регистрация</a></li>
                            <li><a href="<?= \yii\helpers\Url::to(['user/login']) ?>">Войти на сайт</a></li>

                        </ul>
                    </li>
                <?php
                }
                else
                {
                    ?>
                    <li class="active dropdown">
                        <a href="#" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Привет, <?= Yii::$app->user->identity->username ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">

                            <li><a href="<?= \yii\helpers\Url::to(['user/post-anek']) ?>">Отправить анекдот</a></li>

                        </ul>
                    </li>
                <?php

                }
                ?>
            </ul>
        </div>
    </div>
</div>

<div class="container blog-content">
    <div class="row">

        <div class="col-sm-8 blog-main">
            <?= $content ?>
        </div>

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">

            <div class="sidebar-module">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
            </div><!-- /.sidebar-module -->

            <div class="sidebar-module">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4>About</h4>
                        <p>Donec ut libero sed arcu vehicula ultricies a non tortor. <em>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</em> Aenean ut gravida lorem.</p>
                    </div>
                </div>
            </div><!-- /.sidebar-module -->
    </div>

</div><!-- /.container -->

<footer class="blog-footer">

    <div id="links">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <i class="material-icons brand">&#xE871;</i>
                </div>

                <div class="col-sm-8 text-center offset">
                    <ul class="list-inline">
                        <li><a href="/">Домой</a></li>
                    </ul>
                </div>

                <div class="col-md-2 text-right offset">
                    <ul class="list-inline">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</footer>

<button class="material-scrolltop primary" type="button"></button>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
