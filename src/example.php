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

// 插入
$id = $db->insert_kv('logs', [
    'msg' => 'test',
    'created_at' => time(),
]);
var_dump($id);

// 更新
// $sql = 'update logs set msg = ? where id = ?';
// $rows = $db->update($sql, ['test2', 1]);
// var_dump($rows);

// 删除
// $sql = 'delete from logs where id = ?';
// $rows = $db->delete($sql, [2]);
// var_dump($rows);

// 查询
// $sql = 'select * from logs order by id desc';
// $rs = $db->select($sql, [], 1, 2);
// var_dump($rs);

// 单条查询
$sql = 'select * from logs where id = ?';
$log = $db->fetch($sql, [1]);
var_dump($log);

// 取值
$sql = 'select msg from logs where id = ?';
$msg = $db->value($sql, [1]);
var_dump($msg);
