<?php
/**
 * Created by PhpStorm.
 * User: dusty
 * Date: 19.09.16
 * Time: 22:43
 */

/* @var $upload_form \frontend\models\ExcelForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<?php
$form = ActiveForm::begin([
    'id' => 'anek-form',
    'options' => ['class' => 'form-horizontal'],
]);


?>

<?= $form->field($upload_form, 'word')->fileInput() ?>

<?= Html::submitButton('Создать', ['class' => 'btn btn-primary']) ?>
<?php
ActiveForm::end();
?>
