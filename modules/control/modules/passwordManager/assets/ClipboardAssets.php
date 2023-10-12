<?php

namespace app\modules\control\modules\passwordManager\assets;

use yii\web\AssetBundle;

class ClipboardAssets extends AssetBundle
{
    public $sourcePath = '@control/modules/passwordManager/web';

    public $jsOptions = ['position' => \yii\web\View::POS_END];

    public $css = [
        'css/clipboard.handler.css'
    ];

    public $js = [
        'js/clipboard.min.js',
        'js/clipboard.handler.js',
    ];
}
