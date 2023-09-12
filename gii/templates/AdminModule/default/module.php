<?php

/** @var yii\web\View $this */
/** @var \app\gii\templates\AdminModule\Generator $generator */

$className = $generator->moduleClass;
$pos = strrpos($className, '\\');
$ns = ltrim(substr($className, 0, $pos), '\\');
$className = substr($className, $pos + 1);

echo "<?php\n";
?>

namespace <?= $ns ?>;

use app\common\interfaces\ModuleInterface;

/**
 * <?= $generator->moduleID ?> module definition class
 */
class <?= $className ?> extends \yii\base\Module implements ModuleInterface
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = '<?= $generator->getControllerNamespace() ?>';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // здесь находится пользовательский код инициализации
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return '<?= $generator->moduleName ?>';
    }
}
