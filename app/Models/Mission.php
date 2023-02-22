<?php

namespace App\Models;

use App\Helpers\Text;
use DateTime;
use Exception;


class Mission extends Model
{
    /**
     * @var string
     */
    protected $table = 'missions';

    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $title;
    /**
     * @var string|null
     */
    private ?string $created_at;
    /**
     * @var string
     */
    private string $description;
    /**
     * @var string
     */
    private string $nickname;
    /**
     * @var string|null
     */
    private  ?string $closed_at;

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
     * @throws Exception
     */
    public function getCreatedAt(): DateTime
    {
        return (new DateTime($this->created_at));
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

        return nl2br(e(Text::excerpt($this->description, 60)));
    }

    /**
     * @return mixed
     */
    public function getCountries()
    {
        return $this->query("
        SELECT c.* FROM countries c
        JOIN country_mission cm on c.id = cm.country_id
        WHERE cm.mission_id = ?
        ", [$this->id]);
    }

    /**
     * @param array $data
     * @param array|null $relations
     * @return bool
     */
    public function create(array $data, ?array $relations = null): bool
    {
        parent::create($data);

        $id = $this->db->getPDO()->lastInsertId();

        foreach ($relations as $countryId) {
            $stmt = $this->db->getPDO()->prepare("INSERT country_mission(mission_id, country_id) VALUE (?, ?)");
            $stmt->execute([$id, $countryId]);
        }
        return true;
    }

    /**
     * @param int $id
     * @param array $data
     * @param array|null $relations
     * @return true|void
     */
    public function update(int $id, array $data, ?array $relations = null)
    {
        parent::update($id, $data);

        $stmt = $this->db->getPDO()->prepare("DELETE FROM country_mission WHERE mission_id = ?");
        $result = $stmt->execute([$id]);

        foreach ($relations as $countryId) {
            $stmt = $this->db->getPDO()->prepare("INSERT country_mission(mission_id, country_id) VALUE (?, ?)");
            $stmt->execute([$id, $countryId]);
        }

        if ($result) {
            return true;
        }

    }
}
