<?php

namespace app\modules\control\modules\users;

use app\modules\control\interfaces\ModuleInterface;
use yii\base\BootstrapInterface;
use Yii;

/**
 * users module definition class
 */
class Module extends \yii\base\Module implements BootstrapInterface, ModuleInterface
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\control\modules\users\controllers';

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

    /**
     * @param $app
     * @return void
     */
    public function bootstrap($app)
    {
        if ($app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'app\modules\control\modules\users\commands';
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getName(): string
    {
        return 'Пользователи';
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
            'url' => ['/control/users'],
            'active' => $route === 'control/users/default/index',
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
        return Yii::$app->user->can('control.users.access');
    }
}
