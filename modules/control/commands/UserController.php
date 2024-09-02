<?php

namespace app\modules\control\commands;

use app\common\dto\CreateUserDto;
use app\common\enums\DefaultRoles;
use app\common\models\User;
use app\common\services\UserService;
use app\modules\control\modules\users\models\forms\UserCreateForm;
use Exception;
use yii\helpers\Console;

class UserController extends \yii\console\Controller
{
    /**
     * Создание пользователя
     */
    public function actionCreate($username, $password)
    {
        // TODO: переделать!
        $user = User::findByUsername($username);
        if ($user) {
            return Console::output('Такой юзер уже есть!');
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

    /**
     * @return bool|void
     * @throws Exception
     */
    public function actionCreateRoot()
    {
        $dto = new CreateUserDto([
            'username' => 'root',
            'password' => 'root',
            'role' => DefaultRoles::ROOT,
            'status' => User::STATUS_ACTIVE,
            'permissions' => []
        ]);

        try {
            if (UserService::create($dto)) {
                Console::output('Root успешно создан');
                Console::output('');
                Console::output('Логин: root');
                Console::output('Пароль: root');

                return true;
            }
        } catch (Exception $e) {
            Console::output($e->getMessage());
        }

        Console::output('Root пользователь не был создан! Данные для входа по умолчанию: root:root');


    }
}
