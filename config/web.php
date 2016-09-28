<?php

$config = [
    'id' => 'sourcev1',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    //'defaultRoute' => 'site/index',
    'components' => [
        'request' => [
            'cookieValidationKey' => 'SQZcoYKFfPjBQYjRpF1NKwfaRLrBJXD9',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\SRCUser',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [
                'login' => 'site/login',
                'logout' => 'site/logout',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
            'db' => 'localdb',
            //'db' => 'sourcev1',
            
            // 'class' => 'yii\mongodb\Session',
            // 'db' => 'mymongodb',

            // 'sessionTable' => 'session',
            // 'sessionCollection' => 'my_session',
			
            'timeout' => 7200
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '',
        ],
    ],
    'modules' => [
        'config' => [
            'class' => 'app\modules\config\ConfigModule'
        ],
    ],
    'params' => [
        'adminEmail' => 'admin@example.com',
        'envServerMap' => [
            'local' => 'localhost',
            'local-dev' => '127.0.0.1',
            'local-uat' => '127.0.0.1',
            'local-prod' => '127.0.0.1',
        ]
    ],
];

define("DEFAULT_PAGE_SIZE", 15);
define("PAGE_SIZES", "5, 10, 15, 20, 25, 50, all");

/*-------------------------------------------------------------
 * Use YII_ENV_DEV
 -------------------------------------------------------------*/
if (YII_ENV_DEV) {
    /**
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
     */
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        "allowedIPs" => ['127.0.0.1', 'localhost:8888']
    ];
    /**
    //$config["components"]["db"] = $config["components"]["sourcev1"];
    */
    $force_copy = isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest" ? false : true;

    if ($force_copy) {
        $config['components']['assetManager']['forceCopy'] = true;
    }
}

/*-------------------------------------------------------------
 * Separate Environment Configurations
 -------------------------------------------------------------*/
defined("SRC_ENV") or die("SRC_ENV not defined.");

$config_file_path = realpath(__DIR__ . '/env/' . SRC_ENV . '.php');

if (!file_exists($config_file_path))
    die('Configuration file for the "<strong>' . SRC_ENV . '</strong>" does not exist');

require($config_file_path);

if (in_array(SRC_ENV, ['dev','uat','prod'])) {
    foreach (['localdb', 'sourcev1'] as $dbname) {
        if (isset($config["components"][$dbname])) {
            $config["components"][$dbname]["enableSchemaCache"] = true;
            $config["components"][$dbname]["schemaCacheDuration"] = 60 * 60 * 6;
        }
    }
}
/**
$config["components"]["sourcev1"]["on afterOpen"] = function($event) {
    //$event->sender->createCommand("SET ANSI_WARNINGS ON; SET ANSI_PADDING ON;")->execute();
    //$event->sender->createCommand("SET CONCAT_NULL_YIELDS_NULL ON; SET ANSI_WARNINGS ON; SET ANSI_PADDING ON;")->execute();
};
/**/


return $config;
