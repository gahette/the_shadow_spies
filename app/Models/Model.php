<?php

namespace App\Models;

use PDO;

abstract class Model
{
    protected $db;
    protected $table;
    protected $order;

    /**
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function all(?string $order= ""): array
    {
        $sql = "SELECT * FROM {$this->table}";
        if($order){
            $sql .= " ORDER BY " . $order;
        }

        return $this->query($sql);
    }

    public function findById(int $id): Model
    {
        return $this->query("SELECT * FROM $this->table WHERE id = ?", $id, true);
    }

    public function query(string $sql, int $param = null, bool $single = null)
    {
        $method = is_null($param) ? 'query' : 'prepare';
        $fetch = is_null($single) ? 'fetchAll' : 'fetch';
        $stmt = $this->db->getPDO()->$method($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);

        if ($method === 'query') {
            return $stmt->$fetch();
        } else {
            $stmt->execute([$param]);
            return $stmt->$fetch();
        }
    }
}