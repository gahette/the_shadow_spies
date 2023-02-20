<?php

namespace App\Models;

use App\Helpers\Text;
use DateTime;
use Exception;


class Mission extends Model
{
    protected $table = 'missions';

    private int $id;
    private string $title;
    private string $created_at;
    private string $description;
    private string $nickname;
    private string $closed_at;

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
     * @return string
     * @throws Exception
     */
    public function getCreatedAt(): string
    {
        return (new DateTime($this->created_at))->format('d/m/Y à h:m');
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
    public function getNickname(): string
    {
        return $this->nickname;
    }


    /**
     * @return string
     * @throws Exception
     */
    public function getClosedAt(): string
    {
        return (new DateTime($this->closed_at))->format('d/m/Y à h:m');
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

    /**
     * @return mixed
     */
    public function getCountries()
    {
        return $this->query("
        SELECT c.* FROM countries c
        INNER  JOIN country_mission cm on c.id = cm.country_id
        WHERE cm.mission_id = ?
        ", $this->id);
    }
}
