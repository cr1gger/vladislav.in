<?php

namespace app\common\services;

use app\common\dto\CreateUserDto;
use app\common\models\User;

class UserService
{
    /**
     * @param CreateUserDto $dto
     * @return bool|false
     * @throws \Exception
     */
    public static function create(CreateUserDto $dto): bool
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $user = new User();
            $user->username = $dto->username;
            $user->status = $dto->status;
            $user->setPassword($dto->password);
            if (!$user->save()) {
                $transaction->rollBack();
                var_dump($user->getErrors());
                return false;
            }

            if ($dto->role) {
                RbacService::assignRole($user->id, $dto->role);
            }
            if ($dto->permissions) {
                RbacService::assignPermissionList($user->id, $dto->permissions);
            }

            $transaction->commit();

            return true;

        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
}
