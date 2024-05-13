<?php

namespace app\assets;

use yii\web\AssetBundle;

class EditorAsset extends AssetBundle
{
    public $basePath = '@webroot';

    public $baseUrl = '@web/editor';

    public $css = [
        'lib/material-icons.css',
        'lib/base16-light.css',
        'codemirror/lib/codemirror.css',
        'lib/default.css',
        'lib/github-markdown.css',
        'lib/spell-checker.min.css',
        'lib/sweetalert.css',
        'index.css',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];

    public $js = [
        'lib/markdown-it.js',
        'lib/markdown-it-footnote.js',
        'lib/highlight.pack.js',
        'lib/emojify.js',
        'codemirror/lib/codemirror.js',
        'codemirror/overlay.js',
        'codemirror/xml/xml.js',
        'codemirror/markdown/markdown.js',
        'codemirror/gfm/gfm.js',
        'codemirror/javascript/javascript.js',
        'codemirror/css/css.js',
        'codemirror/htmlmixed/htmlmixed.js',
        'codemirror/lib/util/continuelist.js',
        'lib/spell-checker.min.js',
        'lib/rawinflate.js',
        'lib/rawdeflate.js',
        'lib/sweetalert.min.js',
        'index.js',
    ];

    public $depends = [];
}
