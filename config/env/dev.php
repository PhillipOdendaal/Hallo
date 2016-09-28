<?php
/**
$sql_pdo_driver = (IS_WINDOWS_ENV ? 'sqlsrv' : 'mysql');
$sql_server_label = (IS_WINDOWS_ENV ? 'Server' : 'host');
$sql_db_label = (IS_WINDOWS_ENV ? 'Database' : 'dbname');
**/
$config['components']['localdb'] = [
    'class' => 'yii\db\Connection',
    'dsn' => 'sqlite:' . realpath(__DIR__ . "/../../db") . '/localdb.db',
    'charset' => 'utf8',
];
/**
$config['components']['sourcev1'] = [
    'class' => 'app\components\db\SRCConnection',
    'dsn' => '$sql_pdo_driver:$sql_server_label=127.0.0.1;$sql_db_label=SRC_V1',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
 */

$config['components']['db'] = [
    'class' => 'app\components\db\SRCConnection',
    'dsn' => 'mysql:host=127.0.0.1;dbname=SRC_V1',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];