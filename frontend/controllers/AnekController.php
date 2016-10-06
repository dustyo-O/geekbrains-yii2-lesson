<?php
namespace frontend\controllers;

use common\models\Aneks;
use frontend\models\FilterForm;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;


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

    public function actionFeed($cat = null, $page = 1)
    {
        $filter = new FilterForm();

        $post = Yii::$app->request->post();

        if (count($post))
        {
            $filter->load($post);
        }

        if ($cat)
        {
            $filter->category_id = $cat;
        }
        
        $aneks = Aneks::getFeedQuery($page, $filter)->all();

        /* @var $aneks Aneks[] */

        $users = [];
        foreach ($aneks as $a)
        {
            $users[$a->user->id] = $a->user->username;
        }

        if (Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $response = [];
            foreach($aneks as $a) $response[] = $a->toArray();
            return $response;

        }
        else
        {
            return $this->render('feed', [
                'aneks' => $aneks,
                'users' => $users,
                'filter' => $filter
            ]);
        }

    }

    public function actionView($id)
    {
        $anek = Aneks::find()->where(['id' => $id])->one();

        return $this->render('one', [
            'anek' => $anek
        ]);
    }



}
