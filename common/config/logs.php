<?php


$fileLogger = new \Monolog\Logger('app_file_logger');
$fileLoggerHandler = new \Monolog\Handler\StreamHandler(
    __DIR__ . '/../../runtime/logs/' . date('Y-m-d') . '.log',
    \Monolog\Logger::DEBUG
);
$fileLoggerHandler->setFormatter(new \Monolog\Formatter\JsonFormatter());
$fileLogger->pushHandler($fileLoggerHandler);

return [
    'traceLevel' => YII_DEBUG ? 3 : 0,
    'targets' => [
        [
            'class' => 'samdark\log\PsrTarget',
            'logger' => $fileLogger,

            'levels' => ['info', 'error', 'warning'],
            'addTimestampToContext' => true,
        ]
    ],
];