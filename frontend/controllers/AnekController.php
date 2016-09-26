<?php
namespace frontend\controllers;

use common\models\Aneks;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * Blog controller
 */
class AnekController extends Controller
{
    public $layout = 'blog.php';
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
    public function actionIndex()
    {
        $title = 'Привет, мир!';
        return $this->render('index', [
            'caption' => $title
        ]);
    }

    public function actionHello()
    {

        $aneks = Aneks::find()->all();

        return $this->render('feed', [
            'aneks' => $aneks
        ]);

    }


}
