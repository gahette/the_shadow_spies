<?php

namespace App\Controllers;

class MissionController extends Controller
{

    public function welcome()
    {
        return $this->view('mission.welcome');
    }

    public function index()
    {
        $stmt = $this->db->getPDO()->query('SELECT * FROM missions ORDER BY created_at DESC');
        $missions = $stmt->fetchAll();

        return $this->view('mission.index', compact('missions'));

    }

    public function show(int $id)
    {
        $stmt = $this->db->getPDO()->prepare('SELECT * FROM missions WHERE id = ?');
        $stmt->execute([$id]);
        $mission= $stmt->fetch();

        return $this->view('mission.show', compact('mission'));
    }
}
