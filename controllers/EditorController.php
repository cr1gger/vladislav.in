<?php

namespace app\controllers;

use yii\web\Controller;

class EditorController extends Controller
{
    public $layout = 'editor';

    /**
     * {@inheritdoc}
     */

    public function actionIndex()
    {
        return $this->render('index');
    }
}