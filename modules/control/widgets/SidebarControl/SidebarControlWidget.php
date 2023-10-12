<?php

namespace app\modules\control\widgets\SidebarControl;

use app\modules\control\interfaces\ModuleInterface;
use app\modules\control\Module as ControlModule;
use hail812\adminlte\widgets\Menu;
use ReflectionClass;
use Yii;

class SidebarControlWidget extends Menu
{
    private ?ControlModule $controlModule = null;
    /**
     * @return string|void
     */
    public function run()
    {
        $this->controlModule = Yii::$app->getModule(ControlModule::MODULE_NAME);
        $items = [];

        // Главноая кнопка
        $items[] = $this->controlModule::getMenuSettings();

        // Модули
        $items[] = ['label' => 'Модули', 'header' => true];
        foreach ($this->controlModule->modules as $key => $module) {
            $menuModule = $this->getAdminModule($module);
            if ($menuModule) {
                $items[] = $menuModule::getMenuSettings();
            }
        }

        // Инструменты и прочие пункты меню
        $items = array_merge(
            $items,
            $this->toolsItems()
        );

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

    /**
     * @return array
     */
    public function toolsItems(): array
    {
        $items = [];
        $items[] = ['label' => 'Инструменты', 'header' => true];
        $items[] = ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'];

        return $items;
    }
}
