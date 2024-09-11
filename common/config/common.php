<?php

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@control' => '@app/modules/control',
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
    ],
    'container' => [
        'definitions' => [
        ],
        'singletons' => [
            \Psr\Log\LoggerInterface::class => \app\common\logger\Logger::class
        ],

    ]
];
