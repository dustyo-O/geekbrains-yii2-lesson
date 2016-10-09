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



$this->registerJsFile("/js/jquery.grid-a-licious.min.js",['depends' => [\yii\web\JqueryAsset::className()]]);

$like_url = Url::to(['ajax/like']);
$paginator_url = Url::to(['feed', 'page' => '']);
$profile_url = Url::to(['user/profile', 'id' => '']);
$image_url = Url::to(['image/get', 'url' => '']);

$related_url = Url::to(['related', 'id' => '']);

$this->registerJs(<<<JS

    function humanTime(timestamp)
    {
        var date = new Date(timestamp);
        var hours = "0" + date.getHours();
        var minutes = "0" + date.getMinutes();

        var dateString = ('0' + date.getDate()).slice(-2) + '.'
             + ('0' + (date.getMonth()+1)).slice(-2) + '.'
             + date.getFullYear();

        var formattedTime = dateString + ' ' + hours.substr(-2) + ':' + minutes.substr(-2);

        return formattedTime;
    }

    $(document).on("click", ".like-btn",
        function()
        {
            $.ajax(
                {
                    url: "{$like_url}",
                    type: "POST",
                    data: { id: $(this).data("id") },
                    dataType: 'json',
                    context: $(this)
                }
            ).done(
                function(msg) {
                    $(this.empty())
                    if (msg.like)
                    {
                        $(this).addClass('btn-danger');
                    }
                    else
                    {
                        $(this).removeClass('btn-danger');
                    }

                    $(this).text(msg.likes + ' ').append(
                        $("<i/>", {class: "fa fa-heart"})
                    );
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
        
        var url = pattern + String(page);
        
        $.ajax(
        {
            url: url,
            type: 'POST',
            data: $("#filter-form").serialize(),
            dataType: 'json',
            context: $(this)
        }
        ).done(
            function (msg)
            {
                var that = $(this);
                if (msg.aneks.length)
                {
                    $.each(msg.aneks,function(i, anek) {
                        var user = msg.users[anek.user_id];
                        var anek_html = '';
                        var anek_image = '';

                        if (anek.image)
                        {
                            anek_image = $("<span/>", {class: "zoom"}).append(
                                $("<img/>", {src: "{$image_url}" + anek.image, class: "img-responsive"})
                            );
                        }

                        if (anek.text)
                        {
                            anek_html = $("<p/>").html(anek.text);
                        }

                        var like_btn = '';

                        if (anek.like !== null)
                        {
                            like_btn = $("<button/>", {class: "btn like-btn", "data-id": anek.id, text: anek.likes + ' '}).append(
                                $("<i/>", {class:"fa fa-heart"})
                            );

                            if (anek.like) {
                                like_btn.addClass("btn-danger");
                            }
                        }

                        var anek_item = $("<div/>", {class: 'anek-item'}).append(
                            $("<section/>", {class: "blog-post"}).append(
                                $("<div/>", {class: "panel panel-default"}).append(
                                    anek_image
                                ).append(
                                    $("<div/>", {class: "panel-body"}).append(
                                        $("<div/>", {class: "blog-post-meta"}).append(
                                            $("<span/>", {class: "label label-light label-primary", text: anek.category})
                                        ).append(
                                            $("<p/>", {class: "blog-post-date pull-right", text: humanTime(anek.publish_time)})
                                        )
                                    ).append(
                                        $("<div/>", {class: "blog-post-content"}).append(
                                            $("<a/>", {href: "{$profile_url}" + user.id}).append(
                                                $("<h2/>", {class: "blog-post-title pull-right", text: user.username})
                                            )
                                        )
                                        .append(anek_html)
                                        .append(
                                            $("<a/>", {href: "{$related_url}" + anek.id, class: "btn btn-info", text: "Похожие"})
                                        )
                                        .append(
                                            $("<a/>", {href: "#", class: "blog-post-share pull-right"}).append(
                                                $("<i/>", {class: "material-icons"}).html("&#xE80D;")
                                            )
                                        )
                                        .append(
                                            like_btn
                                        )
                                    )
                                )
                            )
                        );

                        $('.anek-row').append(anek_item);

                        if (anek.image) {
                            anek_image.zoom({

                            });
                        }
                    });
                }
                else
                {
                    $(this).before(
                        $("<h3/>",{text: "Больше ничего нет, заходите попозже"})
                    );
                    $(this).remove();
                }
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

.load-more
{
    clear: both;
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

foreach ($aneks as $a)
{
    if (!isset($users[$a->user->id])) {
        $users[$a->user->id] = $a->user->username;
    }
}
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

            $image_url = Url::to(['image/get', 'url' => $a->image]);

            $image_html = <<<HTML
<span class="zoom"><img src="{$image_url}" class="img-responsive"/></span>
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
                        <p class="blog-post-date pull-right"><?= date("d.m.Y H:i", strtotime($a->publish_time)) ?></p>
                    </div>
                    <div class="blog-post-content">
                        <a href="<?= Url::to(['user/profile', 'id' => $a->user->id]) ?>">
                            <h2 class="blog-post-title pull-right"><?= $a->user->username ?></h2>
                        </a>
                        <?= $text_html ?>
                        <a class="btn btn-info" href="<?= Url::to(['anek/related', 'id' => $a->id]) ?>">Похожие</a>
                        <a class="blog-post-share pull-right" href="#">
                            <i class="material-icons">&#xE80D;</i>

                        </a>
                        <?php
                        $red = '';
                        if ($a->userLikes())
                        {
                            $red = ' btn-danger';
                        }
                        ?>
                        <button class="btn like-btn <?= $red ?>" data-id="<?= $a->id ?>"><?= count($a->likes) ?> <i class="fa fa-heart"></i></button>
                    </div>
                </div>
            </div>
        </section><!-- /.blog-post -->


    </div>



    <?php
    }
    ?>


</div>
<button class="load-more btn btn-default">Загрузить еще</button>
