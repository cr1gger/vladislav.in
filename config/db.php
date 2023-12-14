<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => sprintf('mysql:host=%s;dbname=%s', $_ENV['MYSQL_HOST'], $_ENV['MYSQL_DB_NAME']),
    'username' => $_ENV['MYSQL_USERNAME'],
    'password' => $_ENV['MYSQL_PASSWORD'],
    'charset' => 'utf8mb4',
];
