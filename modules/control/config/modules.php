<?php

$modulesDir = __DIR__ . '/../modules';

// Автозагрузка модулей без преднастроек
$config = [];
foreach(scandir($modulesDir) as $moduleDir) {
    if ($moduleDir == '.' || $moduleDir == '..') {
        continue;
    }

    $config[$moduleDir] = [
        'class' => "app\modules\control\modules\\{$moduleDir}\Module"
    ];
}

// Подключение без автозагрузки
//return [
//    'users' => [
//        'class' => \app\modules\control\modules\users\Module::class,
//    ],
//];

return $config;