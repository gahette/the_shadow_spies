<?php

namespace App\Models;

class Country extends Model
{

    protected $table = "countries";
    private int $id;
    private string $name;
    private string $nationalities;
    private string $iso3166;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getNationalities(): string
    {
        return $this->nationalities;
    }

    /**
     * @return string
     */
    public function getIso3166(): string
    {
        return $this->iso3166;
    }

    public function getMissions()
    {
        return $this->query("
    SELECT m.* FROM missions m 
    INNER JOIN country_mission cm on m.id = cm.mission_id
    WHERE cm.country_id = ?
    ", $this->id);
    }
}