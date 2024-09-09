<?php

namespace app\modules\control;

use app\modules\control\helpers\ControlHelper;
use Yii;
use yii\base\BootstrapInterface;
use yii\filters\AccessControl;

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
     * @return array|array[]
     */
    public function behaviors(): array
    {
        if (ControlHelper::isWebApp() && !ControlHelper::isApiRequest()) {
            return [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                        [
                            'actions' => ['login'],
                            'allow' => true,
                            'roles' => ['?'],
                        ],
                    ],
                ],
            ];
        }
        return parent::behaviors();
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->modules = require(__DIR__ . '/config/modules.php');

        if (ControlHelper::isWebApp()) {
            $this->params['publicWeb'] = Yii::$app->assetManager->getPublishedUrl('@control/web');
        }
    }


    public function bootstrap($app)
    {
        if (ControlHelper::isConsoleApp($app)) {
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
