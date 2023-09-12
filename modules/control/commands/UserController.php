<?php

namespace app\modules\control\commands;

use app\common\models\User;
use Exception;

class UserController extends \yii\console\Controller
{
    /**
     * Создание пользователя
     */
    public function actionCreate($username, $password)
    {
        $user = User::findByUsername($username);
        if ($user) {
            throw new Exception('Пользователь с таким именем уже существует');
        }
        $user = new User();
        $user->username = $username;
        $user->setPassword($password);

        if (!$user->validate()) {
            var_dump($user->errors);
            throw new Exception('Ошибка при создании пользователя');
        }

        if(!$user->save()) {
            throw new Exception('Ошибка при создании пользователя');
        }

        echo sprintf("%s успешно создан\nПароль: %s", $username, $password);
    }
}
