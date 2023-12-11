<?php

namespace app\common\services;

use app\common\models\User;
use yii\helpers\ArrayHelper;

class RbacService extends \yii\base\BaseObject
{
    /**
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
     * @param int $userId
     * @param array $permissionList
     * @return bool
     * @throws \Exception
     */
    public static function assignPermissionList(int $userId, array $permissionList): bool
    {
        $result = [];
        foreach ($permissionList as $permission) {
            $result[] = self::assignPermission($userId, $permission);
        }

        return !in_array(null, $result);
    }

    /**
     * @param int $userId
     * @param array $rolesList
     * @return bool
     * @throws \Exception
     */
    public static function assignRolesList(int $userId, array $rolesList): bool
    {
        $result = [];
        foreach ($rolesList as $role) {
            $result[] = self::assignRole($userId, $role);
        }

        return !in_array(null, $result);
    }

    /**
     * @param $userId
     * @return array
     */
    public static function getUserRolesList($userId)
    {
        $manager = \Yii::$app->getAuthManager();

        $permissions = $manager->getRolesByUser($userId);

        return ArrayHelper::getColumn($permissions, 'name');
    }

    /**
     * @param $userId
     * @return array
     */
    public static function getUserPermissionList($userId)
    {
        $manager = \Yii::$app->getAuthManager();

        $permissions = $manager->getPermissionsByUser($userId);

        return ArrayHelper::getColumn($permissions, 'name');
    }


    /**
     * @param $userId
     * @return bool
     */
    public static function removeAll($userId)
    {
        $manager = \Yii::$app->getAuthManager();
        return $manager->revokeAll($userId);
    }
}
