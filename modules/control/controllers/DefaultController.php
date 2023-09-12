<?php

namespace app\modules\control\controllers;

use yii\web\Controller;

/**
 * Default controller for the `control` module
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
