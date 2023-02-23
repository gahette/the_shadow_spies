<?php

namespace App\Models;

/**
 * @property $password
 * @property $admin
 */
class User extends Model
{
    protected $table = 'users';


    public function getByUsername(string $username): User
    {
        return $this->query("SELECT * FROM $this->table WHERE $this->table.lastname = ?", [$username], true);
    }
}