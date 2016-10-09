<?php

namespace app\modules\aneks\controllers;

use backend\controllers\SiteController;
use Yii;
use common\models\Aneks;
use common\models\search\AneksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use common\models\AnekPicture;

/**
 * AneksController implements the CRUD actions for Aneks model.
 */
class AjaxController extends SiteController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge( parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);
    }

    public function actionToggleVisibility()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $response = new \stdClass();

        $id = Yii::$app->request->post('id');
        $v = (int) Yii::$app->request->post('visibility');

        if ($v)
        {
            $v = 0;
        }
        else
        {
            $v = 1;
        }


        $anek = Aneks::findOne($id);
        $anek->is_visible = $v;

        if ($anek->save())
        {
            $response->status = "success";
            $response->is_visible = $v;
        }
        else
        {
            $response->status = "error";
        }

        return $response;
    }

}
