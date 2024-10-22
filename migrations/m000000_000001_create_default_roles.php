<?php

namespace app\migrations;

use yii\db\Migration;
use Yii;

/**
 * Class m231211_190013_create_default_roles
 */
class m000000_000001_create_default_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $roles = [
            'root' => 'Супер-пользователь',
            'admin' => 'Администратор',
            'user'  => 'Пользователь',
        ];

        $manager = Yii::$app->getAuthManager();

        foreach ($roles as $roleIdx => $roleName) {
            $role = $manager->createRole($roleIdx);
            $role->description = $roleName;
            $manager->add($role);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231211_190013_create_default_roles cannot be reverted.\n";

        return false;
    }
}
