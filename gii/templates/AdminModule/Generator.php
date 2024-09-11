<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\gii\templates\AdminModule;

use yii\gii\CodeFile;
use yii\helpers\Html;
use Yii;
use yii\helpers\Inflector;

/**
 * This generator will generate the skeleton code needed by a module.
 *
 * @inheritdoc
 * @property-read string $controllerNamespace The controller namespace of the module.
 * @property-read string $modulePath The directory that contains the module class.
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Generator extends \yii\gii\Generator
{

    /**
     * @var string
     */
    public $moduleID;

    /**
     * @var string
     */
    public $moduleName;

    public $migrationName;

    public function init()
    {
        parent::init();
        $this->migrationName = 'M'
            . '000000000000'
            . Inflector::camelize(sprintf('create_%s_access_permission', $this->moduleID));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Admin Module Generator';
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return 'Генератор модуля для админки';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['moduleID', 'moduleName'], 'trim'],
            [['moduleID', 'moduleName'], 'required'],
            [['moduleID'], 'match', 'pattern' => '/^[\w\\-]+$/', 'message' => 'Only word characters, slashes and dashes are allowed.'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(
            parent::attributeLabels(),
            [
                'moduleID' => 'ID модуля',
                'moduleName' => 'Название модуля',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function hints()
    {
        return array_merge(
            parent::hints(),
            [
                'moduleID' => 'Идентификатор модуля, например, <code>admin</code>.',
                'moduleName' => 'Текстовое название модуля, выводится в меню, например: <code>Панель администратора</code>.',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function successMessage()
    {
        if (Yii::$app->hasModule($this->moduleID)) {
            $link = Html::a('try it now', Yii::$app->getUrlManager()->createUrl($this->moduleID), ['target' => '_blank']);

            return "The module has been generated successfully. You may $link.";
        }

        $output = <<<EOD
<p><strong>Модуль успешно создан!</strong></p>
<p>1. Для включения модуля, добавьте его в список активных модулей <code>app\modules\control\config\modules.php</code>:</p>
<p>2. Добавьте конфигурацию для миграций модуля в секцию <strong>controllerMap</strong> <code>app\config\console.php</code>:</p>
<p></p>
<p>3. Выполните миграцию для создания прав на модуль: <code>php yii migrate-{$this->moduleID}</code> </p>
<p>Так же был сгенерирован Example контроллер для API, вы можете опробовать его отправив GET запрос по <code>/api/gameSpy/example</code></p>
EOD;
        $code = <<<EOD
<?php
    ......
    '{$this->moduleID}' => [
        'class' => {$this->getModuleClass()}::class,
    ],
    ......
EOD;
        $migrationCode = <<<EOD
<?php
    ......
    'migrate-{$this->moduleID}' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationNamespaces' => ['{$this->getMigrationNamespace()}'],
        'migrationTable' => 'migration_{$this->moduleID}',
        'migrationPath' => null,
    ],
    ......
EOD;

        return $output .
            '<p>Код для включение модуля, добавить в <code>app\modules\control\config\modules.php</code></p>'.
            '<pre>' . highlight_string($code, true) . '</pre>' .
            '</br>' .
            '<p>Код для включения миграций модуля</p>'.
            '<pre>' .highlight_string($migrationCode, true). '</pre>';
    }

    /**
     * {@inheritdoc}
     */
    public function requiredTemplates()
    {
        return [
            'module.php',
            'controller.php',
            'view.php',
            'command-controller.php',
            'api-controller.php',
            'migrate-access.php',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        $files = [];
        $modulePath = $this->getModulePath();

        $files[] = new CodeFile(
            $modulePath . '/' . 'Module.php',
            $this->render("module.php")
        );
        $files[] = new CodeFile(
            $modulePath . '/controllers/DefaultController.php',
            $this->render("controller.php")
        );
        $files[] = new CodeFile(
            $modulePath . '/views/default/index.php',
            $this->render("view.php")
        );
        $files[] = new CodeFile(
            $modulePath . '/commands/DefaultController.php',
            $this->render("command-controller.php")
        );
        $files[] = new CodeFile(
            $modulePath . '/api/controllers/ExampleController.php',
            $this->render("api-controller.php")
        );

        $files[] = new CodeFile(
            $modulePath . '/migrations/'. $this->migrationName .'.php',
            $this->render("migrate-access.php")
        );

        return $files;
    }


    /**
     * @return string the directory that contains the module class
     */
    public function getModulePath()
    {
        return Yii::getAlias('@app/modules/control/modules/' . $this->moduleID);
    }

    public function getModuleNamespace() {
        return 'app\modules\control\modules\\' . $this->moduleID;
    }

    /**
     * @return string the commands namespace of the module.
     */
    public function getCommandsNamespace()
    {
        return $this->moduleNamespace . '\commands';
    }

    public function getControllerNamespace()
    {
        return $this->moduleNamespace . '\controllers';
    }

    public function getModuleClass()
    {
        return '\\'.$this->getModuleNamespace() . '\Module';
    }

    public function getApiControllerNamespace()
    {
        return $this->moduleNamespace . '\api\controllers';
    }

    public function getMigrationNamespace()
    {
        return $this->moduleNamespace . '\migrations';
    }
}
