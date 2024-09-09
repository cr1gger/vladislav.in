<?php

namespace app\modules\control\modules\users\api\controllers;

use app\modules\control\base\AuthApiController;
use Yii;

class AccountController extends AuthApiController
{
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;

        return [
            'username' => $user->username,
            'register' => $user->created_at,
            'last_login' => $user->last_login,
        ];
    }
}