<?php

namespace App\Models;

use App\Helpers\Text;
use DateTime;
use Exception;

class Mission extends Model
{
    protected $table = 'missions';
    protected $order = 'created_at';


    private int $id;
    private string $title;
    private $created_at;
    private string $description;
    private string $nickname;
    private $closed_at;

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
    public function getTitle(): string
    {
        return $this->title;
    }


    /**
     * @return DateTime
     * @throws Exception
     */
    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }


    /**
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }


    /**
     * @return DateTime
     * @throws Exception
     */
    public function getClosedAt(): DateTime
    {
        return new DateTime($this->closed_at);
    }

    /**
     * @return string|null
     */
    public function getExcerpt(): ?string
    {
        if ($this->description === null) {
            return null;
        }

        return nl2br(e(Text::excerpt($this->description, 60)));
    }

    public function getCountries()
    {
        return $this->query("
        SELECT c.* FROM countries c
        INNER  JOIN country_mission cm on c.id = cm.country_id
        INNER JOIN missions m on cm.mission_id = m.id
        WHERE m.id = ?", $this->id);
    }
}
