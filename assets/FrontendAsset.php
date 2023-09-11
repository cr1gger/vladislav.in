<?php

namespace app\assets;

use yii\web\AssetBundle;

class FrontendAsset extends AssetBundle
{
    public $basePath = '@webroot';

    public $baseUrl = '@web/frontend';

    public $css = [
        'css/animate.css',
        'css/style.css',
        'css/jquery-ui.css',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];

    public $js = [
        'js/index.js',
        'js/modal-handler.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
