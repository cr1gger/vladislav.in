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

use app\modules\control\interfaces\ModuleInterface;
use yii\base\BootstrapInterface;
use Yii;

/**
 * <?= $generator->moduleID ?> module definition class
 */
class <?= $className ?> extends \yii\base\Module implements BootstrapInterface, ModuleInterface
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
        if (!self::canAccess()) {
            throw new \yii\web\ForbiddenHttpException('Доступ запрещен');
        }
        parent::init();

        // здесь находится пользовательский код инициализации
    }

    public function bootstrap($app)
    {
        if ($app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'app\modules\control\modules\<?= $generator->moduleID ?>\commands';
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getName(): string
    {
        return '<?= $generator->moduleName ?>';
    }

    /**
    * @return array
    */
    public static function getMenuSettings(): array
    {
        $route = Yii::$app->controller->route;

        return [
            'label' => self::getName(),
            'icon' => 'th',
            'url' => ['/control/<?= $generator->moduleID ?>'],
            'active' => $route === 'control/<?= $generator->moduleID ?>/default/index',
            'visible' => true,
            'target' => '_self',
            'iconStyle' => 'fas',
            'iconClassAdded' => '',
            //'iconClass' => 'nav-icon fas fa-th',
            //'badge' => '<span class="right badge badge-danger">New</span>',
        ];
    }

    /**
    * @return bool
    */
    public static function canAccess(): bool
    {
        return Yii::$app->user->can('control.<?= $generator->moduleID ?>.access');
    }
}
