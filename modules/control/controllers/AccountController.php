<?php

namespace app\modules\control\controllers;

use app\common\services\RbacService;
use app\modules\control\components\Toast;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class AccountController extends Controller
{
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;

        if (!$user) {
            throw new \yii\web\ForbiddenHttpException();
        }

        Toast::info('Вы успешно авторизовались');
        $roles = ArrayHelper::getColumn(RbacService::getUserRoles($user->id), 'description');
        $permissions = ArrayHelper::getColumn(RbacService::getUserPermissions($user->id), 'description');

        $this->view->title = 'Личный кабинет';

        return $this->render('index', compact('roles', 'permissions', 'user'));
    }
}
