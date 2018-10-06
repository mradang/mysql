<?php

require_once __DIR__.'/init.php';

// 插入
$id = $db->insert_kv('logs', [
    'msg' => 'test',
    'created_at' => time(),
]);
var_dump($id);
