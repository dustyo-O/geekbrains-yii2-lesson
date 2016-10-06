<?php

namespace app\modules\aneks\controllers;

use Yii;
use common\models\Aneks;
use common\models\search\AneksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\AnekPicture;

/**
 * AneksController implements the CRUD actions for Aneks model.
 */
class AneksController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Aneks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AneksSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //var_dump($searchModel->toArray());die();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Aneks model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Aneks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Aneks();

        $picture = UploadedFile::getInstance($model,'image');
        $image = null;

        if ($picture)
        {
            $image = AnekPicture::uploadImage($picture);
        }

        $model->loadDefaultValues();

        if ($model->load(Yii::$app->request->post())) {
            if ($image) $model->image = $image;

            if ($model->save())
            {
                var_dump($model->toArray());
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                var_dump($model->toArray());
            }
        } else {


            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Aneks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $picture = UploadedFile::getInstance($model,'image');
        $image = null;

        if ($picture)
        {
            $image = AnekPicture::uploadImage($picture);
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($image) $model->image = $image;

            if ($model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }


        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Aneks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Aneks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aneks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Aneks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
