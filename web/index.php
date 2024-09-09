<?php

use Symfony\Component\Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/../.env');

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', (bool)$_ENV['YII_DEBUG']);
defined('YII_ENV') or define('YII_ENV', $_ENV['YII_ENV']);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
