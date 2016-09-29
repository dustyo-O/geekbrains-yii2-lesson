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

        $post = Yii::$app->request->post();

        if (count($post))
        {
            $filter->load($post);

            //var_dump($post);
            $filter->mode = $post["FilterForm"]["mode"];

            //var_dump($filter->mode);

        }


        //var_dump($filter);

        $aneks = Aneks::getFeedQuery(1, $filter)->all();

        /* @var $aneks Aneks[] */

        $users = [];
        foreach ($aneks as $a)
        {
            $users[$a->user->id] = $a->user->username;
        }

        return $this->render('feed', [
            'aneks' => $aneks,
            'users' => $users,
            'filter' => $filter
        ]);
    }

    public function actionView($id)
    {
        $anek = Aneks::find()->where(['id' => $id])->one();

        return $this->render('one', [
            'anek' => $anek
        ]);
    }



}
