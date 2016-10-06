<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\AnekPicture;

/* @var $this yii\web\View */
/* @var $model common\models\Aneks */

$this->title = 'Анекдот #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Aneks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aneks-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user' => [
                'attribute' => 'user_id',
                'value' => $model->user->username
            ],
            'category_id',
            'text:ntext',
            'image' => [
                'attribute' => 'image',
                'value' => AnekPicture::getImageHtml($model->image),
                'format' => 'raw'
            ],
            'publish_time' => [
                'attribute' => 'user_id',
                'value' => date("d.m.Y H:i", strtotime($model->publish_time))
            ],
        ],
    ]) ?>

</div>
