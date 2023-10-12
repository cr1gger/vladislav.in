<?php

namespace app\modules\control\assets;

use yii\web\AssetBundle;

class AssetsCommon extends AssetBundle
{
    public $sourcePath = '@control/web';

    public $jsOptions = ['position' => \yii\web\View::POS_END];

    public $css = [
        'css/sweetalert2.css',
        'css/animate.min.css',
    ];

    public $js = [
        'js/sweetalert2.js',
        'js/common.js',
    ];

    public $depends = [
    ];
}
