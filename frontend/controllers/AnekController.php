<?php
namespace frontend\controllers;

use common\models\Aneks;
use frontend\models\FilterForm;
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

    public function actionFeed($cat = null)
    {


        $filter = new FilterForm();

        $post = Yii::$app->request->post("FilterForm");

        if (count($post))
        {
            $filter->load($post);
        }

        $aneks = Aneks::getFeedQuery(1, $filter)->all();

        return $this->render('feed', [
            'aneks' => $aneks,
            'filter' => $filter
        ]);
    }




}
