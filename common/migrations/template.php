<?php
/**
 * This view is used by console/controllers/MigrateController.php.
 *
 * The following variables are available in this view:
 */
/* @var $className string the new migration class name without namespace */
/* @var $namespace string the new migration class namespace */

echo "<?php\n";
if (!empty($namespace)) {
    echo "\nnamespace {$namespace};\n";
}
?>

use app\common\migrations\BaseMigration;

/**
* Class <?= $className . "\n" ?>
*/
class <?= $className ?> extends BaseMigration
{
/**
* {@inheritdoc}
*/
public function safeUp()
{

}

/**
* {@inheritdoc}
*/
public function safeDown()
{
echo "<?= $className ?> cannot be reverted.\n";

return false;
}

}