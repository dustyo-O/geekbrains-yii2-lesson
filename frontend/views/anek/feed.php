<?php
/**
 * Created by PhpStorm.
 * User: dusty
 * Date: 19.09.16
 * Time: 22:28
 */

use common\models\Aneks;
use yii\helpers\Url;

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

            $image_html = '';
            $text_html = '';
            if (($anek_content->mode === Aneks::MODE_BOTH)||($anek_content->mode === Aneks::MODE_IMAGE))
            {
                $image_html = <<<HTML
    <img src="{$anek_content->image}" class="img-responsive"/>"
HTML;
            }
            if (($anek_content->mode === Aneks::MODE_BOTH)||($anek_content->mode === Aneks::MODE_TEXT))
            {
                $text_html = <<<HTML
    <p>{$anek_content->text}</p>
HTML;
            }
            ?>

        <section class="blog-post">
            <div class="panel panel-default">
                <?= $image_html ?>
                <div class="panel-body">
                    <div class="blog-post-meta">
                        <span class="label label-light label-primary"><?= $a->getCategory() ?></span>
                        <p class="blog-post-date pull-right">February 16, 2016</p>
                    </div>
                    <div class="blog-post-content">
                        <a href="post-image.html">
                            <h2 class="blog-post-title pull-right"><?= $a->user->username ?></h2>
                        </a>
                        <?= $text_html ?>
                        <a class="btn btn-info" href="<?= Url::to(['anek/view', 'id' => $a->id]) ?>">Читать</a>
                        <a class="blog-post-share pull-right" href="#">
                            <i class="material-icons">&#xE80D;</i>
                        </a>
                    </div>
                </div>
            </div>
        </section><!-- /.blog-post -->

    </div>
        <?php
        }
        ?>

</div>
