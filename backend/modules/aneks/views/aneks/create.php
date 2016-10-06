<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Aneks */

$this->title = 'Create Aneks';
$this->params['breadcrumbs'][] = ['label' => 'Aneks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aneks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
