<?php

namespace App\Controllers;

use App\Models\Country;
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
        $missions = $mission->all("created_at DESC");

        return $this->view('mission.index', compact('missions'));

    }

    public function show(int $id)
    {

        $mission = new Mission($this->getDB());
        $mission = $mission->findById($id);

        return $this->view('mission.show', compact('mission'));
    }

    public function country(int $id)
    {

        $country = (new Country($this->getDB()))->findById($id);

        return $this->view('mission.country', compact('country'));
    }
}
