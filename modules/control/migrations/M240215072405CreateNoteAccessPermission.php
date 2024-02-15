<?php

namespace app\modules\control\migrations;

use yii\db\Migration;

/**
 * Class M240215072405CreateNoteAccessPermission
 */
class M240215072405CreateNoteAccessPermission extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $manager = \Yii::$app->getAuthManager();

        $permission = $manager->createPermission('control.notes.access');
        $permission->description = 'Доступ к заметкам';

        $manager->add($permission);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "M240215072405CreateNoteAccessPermission cannot be reverted.\n";

        return false;
    }
}
