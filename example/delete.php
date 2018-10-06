<?php

require_once __DIR__.'/init.php';

// 插入测试数据
$id = $db->insert_kv('logs', [
    'id' => 2,
    'msg' => 'test',
    'created_at' => time(),
]);
var_dump($id);

// 删除
$sql = 'delete from logs where id = ?';
$rows = $db->delete($sql, [2]);
var_dump($rows);
