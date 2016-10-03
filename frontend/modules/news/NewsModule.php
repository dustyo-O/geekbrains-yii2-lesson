<?php

namespace app\modules\news;

/**
 * news module definition class
 */
class NewsModule extends \yii\base\Module
{
    public $layout = '@app/views/layouts/blog.php';
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\news\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
