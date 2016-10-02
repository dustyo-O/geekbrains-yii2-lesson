<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class ZoomAsset extends AssetBundle
{
    public $sourcePath = '@bower/jquery-zoom';
    public $css = [
    ];
    public $js = [
        'jquery.zoom.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',

    ];
}