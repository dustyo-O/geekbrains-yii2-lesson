<?php
namespace frontend\controllers;

use common\models\AnekPicture;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;
use yii\web\Response;


/**
 * Site controller
 */
class ImageController extends Controller
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
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays Image.
     *
     * @return mixed
     */
    public function actionGet($url)
    {
        $image = AnekPicture::readPicture($url);

        if ($image)
        {
            $response = Yii::$app->getResponse();
            $response->headers->set('Content-Type', 'image/jpeg');
            $response->format = Response::FORMAT_RAW;

            return $image;

        }
        else
        {
            throw new NotFoundHttpException("Картинка не найдена");
        }
    }
}
