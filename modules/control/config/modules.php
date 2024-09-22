<?php

$modulesDir = __DIR__ . '/../modules';

$config = [];
foreach(scandir($modulesDir) as $moduleDir) {
    if ($moduleDir == '.' || $moduleDir == '..') {
        continue;
    }

    $config[$moduleDir] = [
        'class' => "app\modules\control\modules\\{$moduleDir}\Module"
    ];
}

return $config;