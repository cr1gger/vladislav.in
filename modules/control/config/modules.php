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

//return [
//    'passwordManager' => [
//        'class' => \app\modules\control\modules\passwordManager\Module::class,
//    ],
//    'users' => [
//        'class' => \app\modules\control\modules\users\Module::class,
//    ],
//    'notes' => [
//        'class' => \app\modules\control\modules\notes\Module::class,
//    ],
//    'spygame' => [
//        'class' => \app\modules\control\modules\spygame\Module::class,
//    ],
//];
