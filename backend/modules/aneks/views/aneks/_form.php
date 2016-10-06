<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Aneks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aneks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Aneks::$categories,'id','title'),['prompt' => \common\models\Aneks::NO_CATEGORY]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?php
    var_dump($model->image);
    ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
