<?php

require_once __DIR__.'/../vendor/autoload.php';

$config = [
    'host' => 'localhost',
    'port' => '3306',
    'database' => 'test',
    'username' => 'test',
    'password' => 'test',
    'charset' => 'utf8',
];

$db = new \mradang\MySQL\MySQL($config);
