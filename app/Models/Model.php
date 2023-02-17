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

 public function all(): array
 {
     $stmt = $this->db->getPDO()->query("SELECT * FROM $this->table ORDER BY $this->order DESC");
     $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this),[$this->db]);
     return $stmt->fetchAll();
 }

 public function findById(int $id): Model
 {
     $stmt = $this->db->getPDO()->prepare("SELECT * FROM missions WHERE id = ?");
     $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this),[$this->db]);
     $stmt->execute([$id]);
     return $stmt->fetch();
 }
}