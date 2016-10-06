<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AneksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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

            'id',
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

        //            'attribute' => 'is_visible',
                    'value' => function($model) {
                        return <<<HTML
<button class="btn btn-default"><i class="fa fa-eye"></i></button>
HTML;

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
