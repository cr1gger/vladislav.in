<?php

namespace app\common\services;

use app\common\dto\CreateUserDto;
use app\common\models\User;
use yii\db\Exception;

class UserService
{
    /**
     * @param CreateUserDto $dto
     * @return User
     * @throws Exception
     */
    public static function create(CreateUserDto $dto): User
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $user = User::findByUsername($dto->username);

            if ($user) {
                throw new \Exception(sprintf('Пользователь с именем %s уже существует!', $dto->username));
            }

            $user = new User();
            $user->username = $dto->username;
            $user->status = $dto->status;
            $user->access_token = $user->generateAccessToken();
            $user->setPassword($dto->password);

            if (!$user->save()) {
                $transaction->rollBack();
                var_dump($user->getErrors());
                throw new \Exception('Ошибка при создании пользователя');
            }

            if ($dto->role) {
                RbacService::assignRole($user->id, $dto->role);
            }
            if ($dto->permissions) {
                RbacService::assignPermissionList($user->id, $dto->permissions);
            }

            $transaction->commit();

            return $user;

        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * Изменение логина пользователя
     * @param int $id
     * @param string $username
     * @return bool
     */
    public static function changeUsername(int $id, string $username): bool
    {
        $existUser = User::find()
            ->where(['username' => $username])
            ->exists();

        if ($existUser) {
            return false;
        }

        $user = User::findOne($id);
        $user->username = $username;
        $user->updateAttributes(['username']);

        return true;
    }

    /**
     * Изменение пароля пользователя
     * @param int $id
     * @param string $password
     * @return bool
     */
    public static function changePassword(int $id, string $password): bool
    {
        $user = User::findOne($id);

        if (!$user) {
            return false;
        }

        $user->setPassword($password);
        $user->updateAttributes(['password']);

        return true;
    }

    /**
     * Создает новый Api Token для пользователя
     * @param int $id
     * @return bool
     */
    public static function regenerateUserToken(int $id): bool
    {
        $user = User::findOne($id);

        if (!$user) {
            return false;
        }

        $user->access_token = $user->generateAccessToken();
        $user->updateAttributes(['access_token']);

        return true;
    }
}
