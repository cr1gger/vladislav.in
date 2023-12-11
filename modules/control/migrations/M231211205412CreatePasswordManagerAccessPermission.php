<?php

namespace app\modules\control\migrations;

use yii\db\Migration;

/**
 * Class M231211205412CreatePasswordManagerAccessPermission
 */
class M231211205412CreatePasswordManagerAccessPermission extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $manager = \Yii::$app->getAuthManager();

        $permission = $manager->createPermission('control.password-manager.access');
        $permission->description = 'Доступ к менеджеру паролей';

        $manager->add($permission);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "M231211205412CreatePasswordManagerAccessPermission cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M231211205412CreatePasswordManagerAccessPermission cannot be reverted.\n";

        return false;
    }
    */
}
