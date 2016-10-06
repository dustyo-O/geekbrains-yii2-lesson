<?php

namespace app\modules\aneks;

/**
 * aneks module definition class
 */
class AneksModule extends \yii\base\Module
{
    public $layout = '@app/views/layouts/cube.php';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\aneks\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
