<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => sprintf('mysql:host=%s;dbname=%s', env['MYSQL_HOST'], env['MYSQL_DATABASE']),
    'username' => env['MYSQL_USER'],
    'password' => env['MYSQL_PASSWORD'],
    'charset' => 'utf8mb4',
];
