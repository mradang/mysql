<?php

require_once __DIR__.'/init.php';

// 查询
$sql = 'select * from logs order by id desc';
$rs = $db->select($sql, [], 1, 2);
var_dump($rs);

// 单条查询
$sql = 'select * from logs where id = ?';
$log = $db->fetch($sql, [1]);
var_dump($log);

// 取值
$sql = 'select msg from logs where id = ?';
$msg = $db->value($sql, [1]);
var_dump($msg);
