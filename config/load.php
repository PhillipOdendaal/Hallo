<?php

$config = [];
$config = require("web.php");

$config["components"]["sourcev1"]["on afterOpen"] = function($event) {
    $event->sender->createCommand("SET CONCAT_NULL_YIELDS_NULL ON; SET ANSI_WARNINGS ON; SET ANSI_PADDING ON;")->execute();
};

return $config;
