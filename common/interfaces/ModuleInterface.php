<?php

namespace app\common\interfaces;

interface ModuleInterface
{
    /**
     * Название модуля
     * @return string
     */
    public function getName(): string;
}
