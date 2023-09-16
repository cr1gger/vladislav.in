<?php

namespace app\modules\control;

use Yii;
use yii\base\BootstrapInterface;

/**
 * control module definition class
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    public const MODULE_NAME = 'control';
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\control\controllers';
    public $layout = 'main';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->modules = require(__DIR__ . '/config/modules.php');
    }


    public function bootstrap($app)
    {
        if ($app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'app\modules\control\commands';
        }
    }

    public static function getName(): string
    {
        return 'Панель управления';
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
            'url' => ['/control'],
            'visible' => true,
            'target' => '_self',
            'iconStyle' => 'fas',
            'iconClassAdded' => '',
            'active' => $route === 'control/default/index',
            //'iconClass' => 'nav-icon fas fa-th',
            //'badge' => '<span class="right badge badge-danger">New</span>',
        ];
    }
}
