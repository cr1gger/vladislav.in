<?php

namespace app\common\migrations;

use Yii;

class MigrateController extends \yii\console\controllers\MigrateController
{
    public $moduleName;
    public $templateFile = '@app/common/migrations/template.php';

    /**
     * @param $actionID
     * @return array|string[]
     */
    public function options($actionID)
    {
        return array_merge(parent::options($actionID), ['moduleName']);
    }

    /**
     * @param $name
     * @return int
     * @throws \yii\console\Exception
     */
    public function actionCreate($name)
    {
        $this->checkModuleExist();

        $this->migrationNamespaces = [
            "app\\modules\\control\\modules\\{$this->moduleName}\\migrations"
        ];

        return parent::actionCreate($name);
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function checkModuleExist()
    {
        $module = Yii::$app->getModule($this->moduleName);

        if (!$module) {
            $controlModule = Yii::$app->getModule("control");

            if (!$controlModule->hasModule($this->moduleName)) {
                throw new \Exception("Module '{$this->moduleName}' not found.");
            }
        }
    }

    /**
     * @return void
     */
    public function init()
    {
        // TODO: открефакторить - сделать через Yii::$app->getModules()
        $modulesDir = __DIR__ . '/../../modules/control/modules/';
        $moduleMigrationNamespaces = [];
        foreach(scandir($modulesDir) as $moduleDir) {
            if ($moduleDir == '.' || $moduleDir == '..') {
                continue;
            }

            $moduleMigrationNamespaces[] = "app\modules\control\modules\\{$moduleDir}\migrations";
        }

        $this->migrationNamespaces = array_merge([
            'app\migrations',
            'app\modules\control\migrations'
        ], $moduleMigrationNamespaces);
    }


}