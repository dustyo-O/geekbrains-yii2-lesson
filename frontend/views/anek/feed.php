<?php
/**
 * Created by PhpStorm.
 * User: dusty
 * Date: 19.09.16
 * Time: 22:28
 */

use common\models\Aneks;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use frontend\assets\ZoomAsset;

/* @var $this yii\web\View */
/* @var $aneks \common\models\Aneks[] */
/* @var $filter \frontend\models\FilterForm */
/* @var $users array */



$this->registerJsFile("js/example.js",['depends' => [\yii\web\JqueryAsset::className()]]);

$like_url = Url::to(['ajax/like']);

$this->registerJs(<<<JS
    $(".like-btn").click(
        function()
        {
            $.ajax(
                {
                    url: "{$like_url}",
                    type: "POST",
                    data: { id: $(this).data("id") },
                    dataType: 'json'
                }
            ).done(
                function() {
                    alert('like');
                }
            );
        }
    );

    $("span.zoom").zoom({
        
    });
JS
);


$this->registerCss(<<<CSS
span.zoom {
    display: inline-block;
}
span.zoom img {
    display: block;
}
CSS
);



$this->title = "Анекдоты";

ZoomAsset::register($this);

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
                $image_src = $a->getImage();
                $image_html = <<<HTML
    <span class="zoom"><img src="{$image_src}" class="img-responsive"/></span>"
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
                        <button class="btn like-btn" data-id="<?= $a->id ?>"><i class="fa fa-heart"></i></button>
                    </div>
                </div>
            </div>
        </section><!-- /.blog-post -->

    </div>
        <?php
        }
        ?>

</div>
