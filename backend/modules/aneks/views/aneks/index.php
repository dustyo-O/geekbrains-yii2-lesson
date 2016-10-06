<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AneksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$visible_url = Url::to(["ajax/toggle-visibility"]);

$this->registerJs(<<<JS
    $(document).on("click",".anek-visible-btn", function () {
        $.ajax(
            {
                url: '{$visible_url}',
                type: 'POST',
                data: {id: $(this).data('id'), visibility: $(this).data('value')},
                dataType: 'json',
                context: $(this)
            }
        ).done(
            function (msg) {
                if (msg.status === 'success')
                {
                    if (parseInt(msg.is_visible) === 0)
                    {
                        
                        $(this).removeClass('btn-success');
                        $(this).addClass('btn-default');
                          
                    }
                    else 
                    {
                        $(this).removeClass('btn-default');
                        $(this).addClass('btn-success');
                        
                    }
                    $(this).data('value', msg.is_visible);
                }
            }
        )
    });
JS

);

$this->title = 'Aneks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aneks-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Aneks', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyCell' => '-',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'user' => [
                'attribute' => 'user',
                'value' => function($model) {
                    return $model->user->username;
                },
            ],
            'category_id' => [
                'attribute' => 'category_id',
                'value' => function($model) {
                    return $model->category_id ? $model->category_id : "без категории";
                },
            ],
            'is_visible' => [
                'attribute' => 'is_visible',
                'value' => function($model) {
var_dump($model->is_visible);
                    if ($model->is_visible)
                    {
                        return <<<HTML
<button class="btn btn-success anek-visible-btn" data-id="{$model->id}" data-value="{$model->is_visible}"><i class="fa fa-eye"></i></button>
HTML;
                    }
                    else
                    {
                        return <<<HTML
<button class="btn btn-default anek-visible-btn" data-id="{$model->id}" data-value="{$model->is_visible}"><i class="fa fa-eye-slash"></i></button>
HTML;

                    }


                },
                'format' => 'raw'

            ],
            'text:ntext',
            //'image',
            // 'publish_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
