<?php

namespace app\modules\control\modules\spygame\controllers;

use yii\web\Controller;

/**
 * Default controller for the `spygame` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
