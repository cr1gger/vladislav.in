<?php

namespace app\common\services;

use app\common\models\User;
use yii\helpers\ArrayHelper;
use yii\rbac\Role;

class RbacService extends \yii\base\BaseObject
{
    /**
     * Назначает пользователю роль
     * @param int $userId
     * @param string $role
     * @return \yii\rbac\Assignment|null
     * @throws \Exception
     */
    public static function assignRole(int $userId, string $role): ?\yii\rbac\Assignment
    {
        $manager = \Yii::$app->getAuthManager();
        $user = User::findOne($userId);
        $role = $manager->getRole($role);

        if (!$user || !$role) {
            return null;
        }

        return $manager->assign($role, $userId);
    }

    /**
     * Назначает пользователю разрешение
     * @param int $userId
     * @param string $permission
     * @return \yii\rbac\Assignment|null
     * @throws \Exception
     */
    public static function assignPermission(int $userId, string $permission): ?\yii\rbac\Assignment
    {
        $manager = \Yii::$app->getAuthManager();
        $user = User::findOne($userId);
        $role = $manager->getPermission($permission);

        if (!$user || !$role) {
            return null;
        }

        return $manager->assign($role, $userId);
    }

    /**
     * Назначает пользователю указанные разрешения
     * @param int $userId
     * @param array|null $permissionList
     * @return bool
     * @throws \Exception
     */
    public static function assignPermissionList(int $userId, ?array $permissionList): bool
    {
        if (empty($permissionList)) {
            self::removeAllPermission($userId);
            return true;
        }

        $result = [];
        foreach ($permissionList as $permission) {
            $result[] = self::assignPermission($userId, $permission);
        }

        return !in_array(null, $result);
    }

    /**
     * Назначает пользователю указанные роли
     * @param int $userId
     * @param array $rolesList
     * @return bool
     * @throws \Exception
     */
    public static function assignRolesList(int $userId, array $rolesList): bool
    {
        if (empty($rolesList)) {
            self::removeAllRoles($userId);
            return true;
        }

        $result = [];
        foreach ($rolesList as $role) {
            $result[] = self::assignRole($userId, $role);
        }

        return !in_array(null, $result);
    }

    /**
     * Возвращает массив ролей пользователя
     * @param $userId
     * @return Role[]
     */
    public static function getUserRoles($userId): array
    {
        $manager = \Yii::$app->getAuthManager();

        return $manager->getRolesByUser($userId);
    }

    /**
     * Возвращает массив разрешений пользователя
     * @param $userId
     * @return Role[]
     */
    public static function getUserPermissions($userId): array
    {
        $manager = \Yii::$app->getAuthManager();

        return $manager->getPermissionsByUser($userId);
    }

    /**
     * Возвращает список ролей пользователя в формате [idx => name]
     * @param $userId
     * @return array
     */
    public static function getUserRolesList($userId): array
    {
        $roles = self::getUserRoles($userId);

        return ArrayHelper::getColumn($roles, 'name');
    }

    /**
     * Возвращает список разрешений пользователя в формате [idx => name]
     * @param $userId
     * @return array
     */
    public static function getUserPermissionList($userId): array
    {
        $permissions = self::getUserPermissions($userId);

        return ArrayHelper::getColumn($permissions, 'name');
    }


    /**
     * Удаляет все роли и разрешения пользователя
     * @param $userId
     * @return bool
     */
    public static function removeAll($userId): bool
    {
        $manager = \Yii::$app->getAuthManager();
        return $manager->revokeAll($userId);
    }

    /**
     * Удаляет все разрешения у пользователя
     * @param int $userId
     * @return void
     */
    public static function removeAllPermission(int $userId)
    {
        $manager = \Yii::$app->getAuthManager();

        $permissions = $manager->getPermissionsByUser($userId);

        foreach ($permissions as $permission) {
            $manager->revoke($permission, $userId);
        }
    }

    /**
     * Удаляет все разрешения у пользователя
     * @param int $userId
     * @return void
     */
    public static function removeAllRoles(int $userId)
    {
        $manager = \Yii::$app->getAuthManager();

        $roles = $manager->getRolesByUser($userId);

        foreach ($roles as $role) {
            $manager->revoke($role, $userId);
        }
    }
}
