<?php
namespace frontend\controllers;

use common\models\Aneks;
use common\models\Likes;
use Yii;
use yii\base\ErrorException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\HttpException;
use yii\web\Response;


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


    public function actionLike()
    {
        $id = Yii::$app->request->post("id");

        if (!$id) {
            throw new BadRequestHttpException("Данные не переданы");
        }

        $anek = Aneks::findOne($id);

        if (!$anek) {
            throw new ErrorException("Анекдот не найден");
        }

        $likes = count($anek->likes);

        if ($anek->userLikes()) {
            Likes::deleteAll(["user_id" => Yii::$app->user->id, "anek_id" => $anek->id]);
            $like = false;
            $likes--;
        } else {
            $like = new Likes();

            $like->user_id = Yii::$app->user->id;
            $like->anek_id = $anek->id;

            if (!$like->save()) {
                throw new ErrorException("Не удалось сохранить лайк");
            }

            $like = true;
            $likes++;
        }
        $result = new \stdClass;

        $result->like = $like;
        $result->likes = $likes;

        Yii::$app->response->format = Response::FORMAT_JSON;

        return $result;
    }
    
}
