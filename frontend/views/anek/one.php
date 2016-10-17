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
/* @var $anek \common\models\Aneks */



$this->title = "Анекдот #".$anek->id;

?>


<div class="row">

    <div class="col-sm-6">
            <?php
            $anek_content = $anek->getContent();
            $image_src = ($anek_content->mode === Aneks::MODE_BOTH)||($anek_content->mode === Aneks::MODE_IMAGE) ?
                $anek->getImage():
                null;
            ?>

        <section class="blog-post">
            <div class="panel panel-default">
                <?php if ($image_src) { ?>
                    <img src="<?= $image_src ?>" class="img-responsive"/>"
                <?php } ?>
                <div class="panel-body">
                    <div class="blog-post-meta">
                        <span class="label label-light label-primary"><?= $anek->getCategory() ?></span>
                        <p class="blog-post-date pull-right">February 16, 2016</p>
                    </div>
                    <div class="blog-post-content">
                        <a href="post-image.html">
                            <h2 class="blog-post-title pull-right"><?= $anek->user->username ?></h2>
                        </a>
                        <?php if ($anek_content->text) { ?>
                            <?= "<p>{$anek_content->text}</p>" ?>
                        <?php } ?>
                        <a class="btn btn-info" href="<?= Url::to(['anek/view', 'id' => $anek->id]) ?>">Читать</a>
                        <a class="blog-post-share pull-right" href="#">
                            <i class="material-icons">&#xE80D;</i>
                        </a>
                    </div>
                </div>
            </div>
        </section><!-- /.blog-post -->
    </div>
</div>
