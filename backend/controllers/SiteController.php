<?php
namespace backend\controllers;

use backend\models\AdminLoginForm;
use common\models\AneksPublish;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Aneks;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $layout = 'cube.php';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'login.php';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new AdminLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * create-anek
     * @return string|\yii\web\Response
     */
    public function actionCreateAnek()
    {
        $anek_form = new AneksPublish();

        $post = Yii::$app->request->post("AneksPublish");
        if (count($post))
        {
            $picture = UploadedFile::getInstance($anek_form,'image');
            $image = null;

            if ($picture)
            {
                $image = AneksPublish::uploadImage($picture);
            }

            $anek_form->text = $post['text'];
            $anek_form->image = $image;
            $anek_form->category_id = $post['category_id'];

            if ($anek_form->createAnek())
            {
                Yii::$app->getSession()->setFlash('success','Анекдот добавлен');
                return $this->refresh();
            }
        }


        return $this->render("create-anek",[
            'anek_form' => $anek_form
        ]);
    }
}
