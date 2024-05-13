<?php

namespace app\controllers;

use yii\web\Controller;

class EditorController extends Controller
{
    public $layout = 'editor';

    public function actionIndex()
    {
        return $this->render('index');
    }
}