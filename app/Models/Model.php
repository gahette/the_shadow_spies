<?php

namespace App\Models;

use Database\DBConnection;
use PDO;

abstract class Model
{
    protected DBConnection $db;
    protected $table;
    protected ?string $order;

    /**
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function all(?string $order = ""): array
    {
        $sql = "SELECT * FROM $this->table";
        if ($order) {
            $sql .= " ORDER BY " . $order;
        }

        return $this->query($sql);
    }

    public function findById(int $id): Model
    {
        return $this->query("SELECT * FROM $this->table WHERE $this->table.id = ?", [$id], true);
    }

    public function create(array $data, ?array $relations = null)
    {
        $firstParenthesis = "";
        $secondParenthesis = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $comma = $i === count($data) ? "" : ', '; //ajout virgule tant qu'il y a un champs
            $firstParenthesis .= "$key$comma";
            $secondParenthesis .= ":$key$comma";
            $i++;
        }
        return $this->query("INSERT INTO $this->table ($firstParenthesis) 
    VALUE ($secondParenthesis)",$data);
    }

    public function update(int $id, array $data, ?array $relations = null)
    {
        $sqlRequestPart = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $comma = $i === count($data) ? "" : ', '; //ajout virgule tant qu'il y a un champs
            $sqlRequestPart .= "$key = :$key$comma";
            $i++;
        }

        $data['id'] = $id;

        return $this->query("UPDATE $this->table SET $sqlRequestPart WHERE $this->table.id = :id", $data);
    }

    public function destroy(int $id): bool
    {
        return $this->query("DELETE FROM $this->table WHERE $this->table.id = ?", [$id]);
    }

    public function query(string $sql, array $param = null, bool $single = null)
    {
        $method = is_null($param) ? 'query' : 'prepare';

        if (strpos($sql, 'DELETE') === 0
            || strpos($sql, 'UPDATE') === 0
            || strpos($sql, 'INSERT') === 0) {
            $stmt = $this->db->getPDO()->$method($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
            return $stmt->execute($param);
        }

        $fetch = is_null($single) ? 'fetchAll' : 'fetch';
        $stmt = $this->db->getPDO()->$method($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);

        if ($method !== 'query') {
            $stmt->execute($param);
        }
        return $stmt->$fetch();
    }
}