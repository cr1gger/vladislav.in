<?php

namespace app\modules\control\modules\users\models;

use yii\helpers\ArrayHelper;

class User extends \app\common\models\User
{

    /**
     * @return array
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();

        $labels['statusName'] = 'Статус пользователя';
        $labels['roles'] = 'Роли';
        $labels['permissions'] = 'Разрешения';

        return $labels;
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        return $this->status == self::STATUS_ACTIVE ? 'Активен' : 'Заблокирован';
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        $manager = \Yii::$app->getAuthManager();
        $roles = $manager->getRolesByUser($this->id);

        return ArrayHelper::map($roles, 'name', 'description');
    }

    /**
     * @return array
     */
    public function getPermissions(): array
    {
        $manager = \Yii::$app->getAuthManager();
        $permissions = $manager->getPermissionsByUser($this->id);

        return ArrayHelper::map($permissions, 'name', 'description');
    }
}
