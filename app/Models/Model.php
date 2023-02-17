<?php

namespace App\Models;

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
     $stmt = $this->db->getPDO()->query("SELECT * FROM {$this->table} ORDER BY {$this->order} DESC");
     return $stmt->fetchAll();
 }

 public function findById(int $id)
 {
     $stmt = $this->db->getPDO()->prepare("SELECT * FROM missions WHERE id = ?");
     $stmt->execute([$id]);
     return $stmt->fetch();
 }
}