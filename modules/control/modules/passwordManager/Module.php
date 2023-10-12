<?php

namespace app\modules\control\modules\passwordManager;

use app\modules\control\interfaces\ModuleInterface;
use yii\base\BootstrapInterface;
use Yii;

/**
 * passwordManager module definition class
 */
class Module extends \yii\base\Module implements BootstrapInterface, ModuleInterface
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\control\modules\passwordManager\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // здесь находится пользовательский код инициализации
    }

    public function bootstrap($app)
    {
        if ($app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'app\modules\control\modules\passwordManager\commands';
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getName(): string
    {
        return 'Менеджер паролей';
    }

    /**
     * @return array
     */
    public static function getMenuSettings(): array
    {
        return [
            'label' => self::getName(),
            'icon' => 'th',
            'url' => ['/control/passwordManager'],
            'visible' => true,
            'target' => '_self',
            'iconStyle' => 'fas',
            'iconClassAdded' => '',
            'items' => self::menuItems(),
            //'iconClass' => 'nav-icon fas fa-th',
            //'badge' => '<span class="right badge badge-danger">New</span>',
        ];
    }

    /**
     * @return array
     */
    public static function menuItems(): array
    {
        $route = Yii::$app->controller->route;

        return [
            [
                'label' => 'Список паролей',
                'icon' => 'file-code',
                'url' => ['/control/passwordManager/store'],
                'active' => $route === 'control/passwordManager/store/index',
            ]
        ];
    }
}
