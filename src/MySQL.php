<?php

namespace mradang\MySQL;

class MySQL {

    public $pdo;

    public function __construct(array $config) {
        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s',
            $config['host'], $config['port'], $config['database']
        );
        $this->pdo = new \PDO(
            $dsn, $config['username'], $config['password']
        );

        $charset = sprintf("SET NAMES '%s'", isset($config['charset']) ?: 'utf8mb4');
        $this->pdo->exec($charset);

        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function select(string $sql, array $data = [], int $page = 0, int $pagesize = 0) {
        if ($page && $pagesize) {
            $sql .= ' LIMIT ? OFFSET ?';
        }

        $sth = $this->pdo->prepare($sql);
        $i = 0;
        foreach($data as $param) {
            $sth->bindValue(++$i, $param);
        }

        if ($page && $pagesize) {
            $sth->bindValue(++$i, $pagesize, \PDO::PARAM_INT);
            $sth->bindValue(++$i, ($page - 1) * $pagesize, \PDO::PARAM_INT);
        }

        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetch(string $sql, array $data = []) {
        $sth = $this->pdo->prepare($sql);
        if (count($data)) {
            $sth->execute($data);
        } else {
            $sth->execute();
        }
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }

    public function value(string $sql, array $data = []) {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($data);
        return $sth->fetchColumn();
    }

    public function insert(string $sql, array $data) {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($data);
        return $this->pdo->lastInsertId();
    }

    public function insert_kv(string $table_name, array $data) {
        $keys = array_keys($data);
        $fields = '';
        foreach ($keys as $key) {
            $fields .= sprintf('`%s`,', $key);
        }
        $fields = rtrim($fields, ',');

        $vals = array_values($data);
        $placeholder = rtrim(str_repeat('?,', count($vals)), ',');

        $sql = "insert into $table_name ($fields) values ($placeholder)";

        return $this->insert($sql, $vals);
    }

    public function update(string $sql, array $data) {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($data);
        return $sth->rowCount();
    }

    public function delete(string $sql, array $data) {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($data);
        return $sth->rowCount();
    }

}
