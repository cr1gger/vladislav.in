<?php

namespace app\modules\control\migrations;

use yii\db\Migration;

/**
 * Class M231211205544CreateUsersAccessPermission
 */
class M231211205544CreateUsersAccessPermission extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $manager = \Yii::$app->getAuthManager();

        $permission = $manager->createPermission('control.users.access');
        $permission->description = 'Доступ к пользователям';

        $manager->add($permission);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "M231211205544CreateUsersAccessPermission cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M231211205544CreateUsersAccessPermission cannot be reverted.\n";

        return false;
    }
    */
}
