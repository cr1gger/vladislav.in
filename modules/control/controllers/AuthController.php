<?php

namespace app\modules\control\controllers;

use app\modules\control\models\forms\Login;
use Yii;
use yii\web\Controller;

class AuthController extends Controller
{
    public $layout = 'main-login';

    public function actionLogin()
    {
        $model = new Login();
        $model->load(Yii::$app->request->post());

        return $this->render('login', compact('model'));
    }
}
