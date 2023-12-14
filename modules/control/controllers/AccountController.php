<?php

namespace app\modules\control\controllers;

use app\common\services\RbacService;
use app\common\services\UserService;
use app\modules\control\components\Toast;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class AccountController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'change' => ['post'],
                ],
            ]
        ];
    }

    /**
     * @return string
     * @throws \yii\web\ForbiddenHttpException
     */
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;

        if (!$user) {
            throw new \yii\web\ForbiddenHttpException();
        }

        $roles = ArrayHelper::getColumn(RbacService::getUserRoles($user->id), 'description');
        $permissions = ArrayHelper::getColumn(RbacService::getUserPermissions($user->id), 'description');

        $this->view->title = 'Личный кабинет';

        return $this->render('index', compact('roles', 'permissions', 'user'));
    }

    /**
     * @return \yii\web\Response
     */
    public function actionChange()
    {
        $data = Yii::$app->request->post();
        $usernameChanged = $passwordChanged = false;

        if (!empty($data['username'])) {
            $usernameChanged = UserService::changeUsername(Yii::$app->user->identity->id, $data['username']);
        }

        if (!empty($data['new-password'])) {
            $passwordChanged = UserService::changePassword(Yii::$app->user->identity->id, $data['new-password']);
        }

        if ($usernameChanged && !$passwordChanged) {
            Toast::success('Логин для входа успешно изменен!');
        } elseif (!$usernameChanged && $passwordChanged) {
            Toast::success('Пароль успешно изменен!');
        } elseif ($usernameChanged && $passwordChanged) {
            Toast::success('Данные успешно изменены!');
        }

        return $this->redirect(['index']);

    }
}
