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
$paginator_url = Url::to(['feed', 'page' => '']);

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
    
    var page = 1;

    $(".load-more").click(
    function(){
        
        page = page + 1;
        var pattern = '{$paginator_url}';
        
        var url = pattern+String(page);
        
        $.ajax(
        {
            url: url,
            type: 'POST',
            data: $("#filter-form").serialize(),
            dataType: 'json'
        }
        ).done(
            function ()
            {
                
            }
        )            
    }
);
JS
);


$this->registerCss(<<<CSS
span.zoom {
    display: inline-block;
}
span.zoom img {
    display: block;
}

.anek-row {
 -moz-column-width: 18em;
 -webkit-column-width: 18em;
 -moz-column-gap: 1em;
 -webkit-column-gap:1em;

}

.anek-item {
 display: inline-block;
 padding:  .25rem;
 width:  100%;
}
CSS
);



$this->title = "Анекдоты";

ZoomAsset::register($this);

?>
<?php
$form = ActiveForm::begin([
    'id' => 'filter-form',
    'options' => ['class' => 'form-horizontal'],
]);
?>
<?= $form->field($filter, 'user')->dropDownList($users,['prompt' => 'Все пользователи']) ?>
<?= $form->field($filter, 'mode')->checkboxList(Aneks::$modes) ?>
<?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
<?php
ActiveForm::end();
?>


<div class="anek-row">
    <?php


    foreach ($aneks as $a)
    {
        /* @var $a Aneks */

    ?>
    <div class="anek-item">
        <?php
        $anek_content = $a->getContent();

        $image_html = '';
        $text_html = '';
        if (($anek_content->mode === Aneks::MODE_BOTH)||($anek_content->mode === Aneks::MODE_IMAGE))
        {
            $image_src = $a->getImage();
            $image_html = <<<HTML
<span class="zoom"><img src="{$image_src}" class="img-responsive"/></span>
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

    <button class="load-more btn btn-default">Загрузить еще</button>

    <?php
    }
    ?>


</div>
