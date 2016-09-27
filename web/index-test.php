<?php

// NOTE: Make sure this file is not accessible when deployed to production
if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
    die('You are not allowed to access this file.');
}

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'uat');
defined('IS_WINDOWS_ENV') or define('IS_WINDOWS_ENV', strtoupper(substr(PHP_OS, 0, 3)) == "WIN");
defined('SRC_ENV') or define('SRC_ENV', 'uat');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');


$config = require(__DIR__ . '/../config/load.php');

(new yii\web\Application($config))->run();
