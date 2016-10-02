<?php
namespace frontend\controllers;

use common\models\Aneks;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\HttpException;


/**
 * Blog controller
 */
class AjaxController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionLike()
    {
        $id = Yii::$app->request->post("id");

        if ($id !== null)
        {
            $id = (int) $id;
            return <<<JSON
{"status": "success", "id": "{$id}"}
JSON;

        }
        else
        {
            header("HTTP/1.1 404 Not Found");
            echo '{"status": "error", "message": "Данные не переданы"}';
            die();
        }
    }


}
