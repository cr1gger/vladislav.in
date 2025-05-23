<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$common = require __DIR__ . '/../common/config/common.php';
$logs = require __DIR__ . '/../common/config/logs.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'modules' => [
        'control' => [
            'class' => \app\modules\control\Module::class,
        ],
    ],
    'homeUrl' => '/',
    'components' => [
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'appendTimestamp' => true,
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'jsOptions' => [
                        'position' => \yii\web\View::POS_HEAD
                    ],
                ],
            ]
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'DwzLuN-qg7TpTln1xh5gyAm6ReMSzwi7',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => app\models\WebUser::class,
            'identityClass' => \app\common\models\User::class,
            'enableAutoLogin' => false,
            'loginUrl' => ['control/auth/login'],
        ],
        'errorHandler' => [
            'errorAction' => '/control/default/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true, // TODO: Исправить, сделать нормальный почтовый сервер
        ],
        'log' => $logs,
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require_once 'url_rules.php',
        ],
    ],
    'params' => $params,
    'defaultRoute' => 'site/index',
];

if (YII_ENV_DEV) {
    if (YII_DEBUG) {
        $config['bootstrap'][] = 'debug';
        $config['modules']['debug'] = [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['*'],
        ];
    }

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
        'generators' => [
            'adminModule' => [
                'class' => \app\gii\templates\AdminModule\Generator::class, // класс генератора
                'templates' => [
                    'adminModule' => '@app/gii/templates/AdminModule',
                ]
            ]
        ],
    ];
}

return array_merge_recursive($common, $config);
