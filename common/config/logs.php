<?php


$fileLogger = new \Monolog\Logger('app_file_logger');
$fileLoggerHandler = new \Monolog\Handler\StreamHandler(
    __DIR__ . '/../../runtime/logs/' . date('Y-m-d') . '.log',
    YII_DEBUG ? \Monolog\Logger::DEBUG : \Monolog\Logger::INFO,
);
$fileLoggerHandler->setFormatter(new \Monolog\Formatter\JsonFormatter());
$fileLogger->pushHandler($fileLoggerHandler);
$fileLogger->pushProcessor(new \Monolog\Processor\PsrLogMessageProcessor());

return [
    'traceLevel' => YII_DEBUG ? 3 : 0,
    'targets' => [
        [
            'class' => 'samdark\log\PsrTarget',
            'logger' => $fileLogger,
            'levels' => ['info', 'error', 'warning'],
//            'addTimestampToContext' => true,
//            'categories' => [
//                'app/*'
//            ]
        ]
    ],
];