<?php

namespace app\modules\control\widgets\SidebarControl;

use app\modules\control\interfaces\ModuleInterface;
use app\modules\control\Module as ControlModule;
use hail812\adminlte\widgets\Menu;
use ReflectionClass;
use Yii;

class SidebarControlWidget extends Menu
{
    /**
     * @return string|void
     */
    public function run()
    {
        /* @var ControlModule $controlModule */
        $controlModule = Yii::$app->getModule(ControlModule::MODULE_NAME);
        $items = [
            $controlModule::getMenuSettings()
        ];

        foreach ($controlModule->modules as $key => $module) {
            $menuModule = $this->getAdminModule($module);
            if ($menuModule) {
                $items[] = $menuModule::getMenuSettings();
            }
        }
        $this->items = $items;

        return parent::run();
    }

    public function getAdminModule($module)
    {
        if ($module instanceof ModuleInterface)
        {
            return $module;
        }

        if (($module['class'] ?? null) && class_exists($module['class'])) {

            $reflection = new ReflectionClass($module['class']);

            if($reflection->implementsInterface(ModuleInterface::class)) {
                return '\\'.$module['class'];
            }
        }

        return false;
    }
}
