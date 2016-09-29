<?php
/**
 * Created by PhpStorm.
 * User: dusty
 * Date: 19.09.16
 * Time: 22:43
 */

/* @var $anek_form \common\models\AneksPublish */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<?php
$form = ActiveForm::begin([
    'id' => 'anek-form',
    'options' => ['class' => 'form-horizontal'],
]);


?>
<?= $form->field($anek_form, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Aneks::$categories,'id','title'),['prompt' => \common\models\Aneks::NO_CATEGORY]) ?>
<?= $form->field($anek_form, 'text')->textarea() ?>
<?= $form->field($anek_form, 'image')->fileInput() ?>

<?= Html::submitButton('Создать', ['class' => 'btn btn-primary']) ?>
<?php
ActiveForm::end();
?>
