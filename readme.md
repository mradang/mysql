# PDO-MySQL

## 安装
```
composer require mradang/MySQL
```

## 使用
```php
// 初始化
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

// 更新
$sql = 'update logs set msg = ? where id = ?';
$rows = $db->update($sql, ['test2', 1]);

// 删除
$sql = 'delete from logs where id = ?';
$rows = $db->delete($sql, [2]);

// 查询
$sql = 'select * from logs order by id desc';
$rs = $db->select($sql, [], 1, 2);

// 单条查询
$sql = 'select * from logs where id = ?';
$log = $db->fetch($sql, [1]);

// 取值
$sql = 'select msg from logs where id = ?';
$msg = $db->value($sql, [1]);
```