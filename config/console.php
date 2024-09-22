<?php

use app\modules\control\Module as ControlModule;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$common = require __DIR__ . '/../common/config/common.php';

$modulesDir = __DIR__ . '/../modules/control/modules/';

$moduleMigrationNamespaces = [];
foreach(scandir($modulesDir) as $moduleDir) {
    if ($moduleDir == '.' || $moduleDir == '..') {
        continue;
    }

    $moduleMigrationNamespaces[] = [
        "app\modules\control\modules\\{$moduleDir}\migrations"
    ];
}

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'control'],
    'controllerNamespace' => 'app\commands',
    'modules' => [
        'control' => ControlModule::class
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,

    'controllerMap' => [
        'migrate-control' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => [
                'app\modules\control\migrations'
            ],
            'migrationTable' => 'migration_control',
            'migrationPath' => null,
        ],
        'migrate-modules' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => $moduleMigrationNamespaces,
            'migrationTable' => 'migration_modules',
            'migrationPath' => null,
        ]
    ],

];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
    // configuration adjustments for 'dev' environment
    // requires version `2.1.21` of yii2-debug module
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return array_merge_recursive($common, $config);
