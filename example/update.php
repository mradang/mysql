<?php

require_once __DIR__.'/init.php';

// 更新
$sql = 'update logs set msg = ? where id = ?';
$rows = $db->update($sql, ['test'.time(), 1]);
var_dump($rows);
