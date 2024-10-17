<?php

namespace app\models;

use app\common\enums\DefaultRoles;
use yii\web\User;

class WebUser extends User
{
    /**
     * @param $permissionName
     * @param $params
     * @param $allowCaching
     * @return bool
     */
//    public function can($permissionName, $params = [], $allowCaching = true)
//    {
//        $manager = \Yii::$app->getAuthManager();
//        $userRoles = $manager->getRolesByUser($this->getId());
//
//        foreach ($userRoles as $role) {
//            if ($role->name == DefaultRoles::ROOT) {
//                return true;
//            }
//        }
//
//        return parent::can($permissionName, $params, $allowCaching);
//    }
}
