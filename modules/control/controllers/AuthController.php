<?php

namespace app\modules\control\controllers;

use app\modules\control\models\forms\Login;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class AuthController extends Controller
{
    public $layout = 'main-login';

    public function actionLogin()
    {
        $model = new Login();
        if ($model->load(Yii::$app->request->post())) {
            if($model->authorize()) {
                return $this->redirect(['default/index']);
            }
        }

        return $this->render('login', compact('model'));
    }
}
