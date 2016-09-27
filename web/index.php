<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
defined('IS_WINDOWS_ENV') or define('IS_WINDOWS_ENV', strtoupper(substr(PHP_OS, 0, 3)) == "WIN");

defined('SRC_ENV') or define('SRC_ENV', 'dev'); // local, dev, uat, prod

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/load.php');

(new yii\web\Application($config))->run();
