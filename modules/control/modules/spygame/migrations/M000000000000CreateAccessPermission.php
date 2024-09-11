<?php

namespace app\modules\control\modules\spygame\migrations;

use yii\db\Migration;

class M000000000000CreateAccessPermission extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $manager = \Yii::$app->getAuthManager();

        $permission = $manager->createPermission('control.spygame.access');
        $permission->description = 'Доступ к модулю: Игра шпион';

        $manager->add($permission);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "M000000000000CreateAccessPermission cannot be reverted.\n";

        return false;
    }
}
