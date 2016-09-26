<?php
/**
 * Created by PhpStorm.
 * User: dusty
 * Date: 19.09.16
 * Time: 22:28
 */

/* @var $this yii\web\View */
/* @var $aneks \common\models\Aneks[] */



$this->title = "Анекдоты";


?>


<div class="row">
        <?php
        foreach ($aneks as $a)
        {
        ?>
    <div class="col-sm-6">
        <?php
        $anek_content = $a->getContent();
        ?>
        <?php
        if ($anek_content->mode === \common\models\Aneks::MODE_BOTH)
        {
        ?>
        <section class="blog-post">
            <div class="panel panel-default">
                <img src="<?= $anek_content->image ?>" class="img-responsive"/>
                <div class="panel-body">
                    <div class="blog-post-meta">
                        <span class="label label-light label-primary"><?= $a->getCategory() ?></span>
                        <p class="blog-post-date pull-right">February 16, 2016</p>
                    </div>
                    <div class="blog-post-content">
                        <a href="post-image.html">
                            <h2 class="blog-post-title">Like a little drop of ink</h2>
                        </a>
                        <p><?= $anek_content->text ?></p>
                        <a class="btn btn-info" href="post-image.html">Read more</a>
                        <a class="blog-post-share pull-right" href="#">
                            <i class="material-icons">&#xE80D;</i>
                        </a>
                    </div>
                </div>
            </div>
        </section><!-- /.blog-post -->
        <?php
        }
        ?>
        <?php
        if ($anek_content->mode === \common\models\Aneks::MODE_IMAGE)
        {
        ?>
        <section class="blog-post">
            <div class="panel panel-default">
                <img src="<?= $anek_content->image ?>" class="img-responsive"/>
                <div class="panel-body">
                    <div class="blog-post-meta">
                        <span class="label label-light label-primary"><?= $a->getCategory() ?></span>
                        <p class="blog-post-date pull-right">February 16, 2016</p>
                    </div>
                    <div class="blog-post-content">

                        <a class="btn btn-info" href="post-image.html">Read more</a>
                        <a class="blog-post-share pull-right" href="#">
                            <i class="material-icons">&#xE80D;</i>
                        </a>
                    </div>
                </div>
            </div>
        </section><!-- /.blog-post -->
        <?php
        }
        ?>
        <?php
        if ($anek_content->mode === \common\models\Aneks::MODE_TEXT)
        {
        ?>
        <section class="blog-post">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="blog-post-meta">
                        <span class="label label-light label-primary"><?= $a->getCategory() ?></span>
                        <p class="blog-post-date pull-right">February 16, 2016</p>
                    </div>
                    <div class="blog-post-content">
                        <p><?= $anek_content->text ?></p>
                        <a class="btn btn-info" href="post-image.html">Read more</a>
                        <a class="blog-post-share pull-right" href="#">
                            <i class="material-icons">&#xE80D;</i>
                        </a>
                    </div>
                </div>
            </div>
        </section><!-- /.blog-post -->
        <?php
        }
        ?>
    </div>
        <?php
        }
        ?>

</div>
