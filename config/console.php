<?php

$config = [
    'id' => 'sourcev1-console',
    'basePath' => dirname(__DIR__),
	//'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'timeZone' => 'Africa/Johannesburg',
    'modules' => [
        'websocket' => [
            'class' => 'app\modules\websocket\WebsocketModule'
        ],
        'console' => [
            'class' => 'app\modules\console\ConsoleModule'
        ]
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
    ],
];

//defined("SRC_ENV") or die("SRC_ENV not defined.");'
defined('SRC_ENV') or define('SRC_ENV', 'env/dev'); // local, dev, uat, prod

$config_file_path = realpath(__DIR__ . '/' . SRC_ENV . '.php');
if (!file_exists($config_file_path))
    die('Configuration file for the "' . SRC_ENV . '" environment does not exist\n');

require($config_file_path);
return $config;
