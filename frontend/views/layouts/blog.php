<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\BlogAsset;
use yii\helpers\Html;


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
            <a class="navbar-brand" href="index.html"><i class="material-icons">&#xE871;</i> Material Blog</a>
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse">
            <ul class="nav navbar-nav">
                <li class="active dropdown">
                    <a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Stories <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="home-fashion.html">Fashion</a></li>
                        <li><a href="home-food.html">Food</a></li>
                        <li><a href="home-music.html">Music</a></li>
                        <li><a href="home-photography.html">Photography</a></li>
                        <li><a href="home-technology.html">Technology</a></li>
                        <li><a href="home-travel.html">Travel</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Filters <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="filter-category.html">Category</a></li>
                        <li><a href="filter-author.html">Author</a></li>
                        <li><a href="filter-date.html">Date</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Post <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="post-image.html">Image post</a></li>
                        <li><a href="post-video.html">Video post</a></li>
                    </ul>
                </li>
                <li><a href="page-about.html">About</a></li>
                <li><a href="page-contact.html">Contact</a></li>
                <li class="dropdown hidden-sm">
                    <a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Documentation <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="doc-buttons.html">Buttons</a></li>
                        <li><a href="doc-forms.html">Forms</a></li>
                        <li><a href="doc-icons.html">Icons</a></li>
                        <li><a href="doc-indicators.html">Indicators</a></li>
                        <li><a href="doc-navbars.html">Navbars</a></li>
                        <li><a href="doc-panels.html">Panels</a></li>
                        <li><a href="doc-tables.html">Tables</a></li>
                        <li><a href="doc-typography.html">Typography</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
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
                        <li><a href="index.html">Home</a></li>
                        <li><a href="page-about.html">About</a></li>
                        <li><a href="doc-buttons.html">Documentation</a></li>
                        <li><a href="page-contact.html">Contact</a></li>
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
