<?php

namespace app\modules\control\interfaces;

interface ModuleInterface
{
    /**
     * Название модуля
     * @return string
     */
    public static function getName(): string;

    /**
     * @return array
     */
    public static function getMenuSettings(): array;

}
