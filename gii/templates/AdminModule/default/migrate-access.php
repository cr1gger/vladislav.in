<?php
/**
 * This is the template for generating a migration class within a module.
 */

/** @var app\gii\templates\AdminModule\Generator $generator */

echo "<?php\n";
?>

namespace <?=$generator->getMigrationNamespace()?>;

use yii\db\Migration;

class <?=$generator->migrationName?> extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $manager = \Yii::$app->getAuthManager();

        $permission = $manager->createPermission('control.<?=$generator->moduleID?>.access');
        $permission->description = 'Доступ к модулю: <?=$generator->moduleName?>';

        $manager->add($permission);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "<?=$generator->migrationName?> cannot be reverted.\n";

        return false;
    }
}
