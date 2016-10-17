<?php
namespace console\controllers;

use yii\console\Controller;
use common\models\Aneks;

class CommandController extends Controller
{
  const ERROR_ANEK_NOT_SAVED = 1;

  public function actionHello($text = null)
  {
    $anek = new Aneks();
    if ($text === null) $text = date("d.m.Y H:i:s");
    $anek->user_id = 1;
    $anek->is_visible = 1;
    $anek->text = $text;
    if ($anek->save())
    {
      echo PHP_EOL.$text.PHP_EOL.'ok'.PHP_EOL;
      return 0;
    }
    else
    {
      echo PHP_EOL.'error'.PHP_EOL;
      return ERROR_ANEK_NOT_SAVED;
    }

  }

  public function actionConvertUrl($url, $id)
  {
    $image_path = \Yii::getAlias('@root').'/upload/'.$id.'.jpg';
    echo shell_exec("wkhtmltoimage $url $image_path");
    echo $image_path;
  }
}
