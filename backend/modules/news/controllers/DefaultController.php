<?php

namespace app\modules\news\controllers;

use yii\web\Controller;

/**
 * Default controller for the `news` module
 */
class DefaultController extends Controller
{
//    public $layout = '@app/views/layouts/blog.php';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
