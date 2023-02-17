<?php

namespace App\Controllers;

use App\Models\Mission;

class MissionController extends Controller
{

    public function welcome()
    {
        return $this->view('mission.welcome');
    }

    public function index()
    {
        $mission = new Mission($this->getDB());
        $missions = $mission->all();

        return $this->view('mission.index', compact('missions'));

    }

    public function show(int $id)
    {
        $mission = new Mission($this->getDB());
        $mission = $mission->findById($id);

        return $this->view('mission.show', compact('mission'));
    }
}
