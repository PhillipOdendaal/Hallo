<?php

$mssql_pdo_driver = (IS_WINDOWS_ENV ? 'sqlsrv' : 'dblib');
$mssql_server_label = (IS_WINDOWS_ENV ? 'Server' : 'host');
$mssql_db_label = (IS_WINDOWS_ENV ? 'Database' : 'dbname');

$config['components']['localdb'] = [
    'class' => 'yii\db\Connection',
    'dsn' => 'sqlite:' . realpath(__DIR__ . "/../../db") . '/localdb.db',
    'charset' => 'utf8',
];

$config['components']['sourcev1'] = [
    'class' => 'app\components\db\SRCConnection',
	'dsn' => "$mssql_pdo_driver:$mssql_server_label=0.0.0.0;$mssql_db_label=SRC_V1",
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
