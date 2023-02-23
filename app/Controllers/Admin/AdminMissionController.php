<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Country;
use App\Models\Mission;

class AdminMissionController extends Controller
{
    public function index()
    {
        $this->isAdmin();

        $missions = (new Mission($this->getDB()))->all("created_at DESC");

        return $this->view('admin.mission.index', compact('missions'));
    }

    public function create()
    {
        $this->isAdmin();

        $countries = (new Country($this->getDB()))->all();

        return $this->view('admin.mission.form', compact('countries'));
    }

    public function createMission()
    {
        $this->isAdmin();

        $mission = new Mission($this->getDB());

        $countries = array_pop($_POST);
        $result = $mission->create($_POST, $countries);

        if ($result) {
            return header('Location: /the_shadow_spies/admin/missions');
        }
        return $this;
    }

    public function edit(int $id)
    {
        $this->isAdmin();

        $mission = (new Mission($this->getDB()))->findById($id);
        $countries = (new Country($this->getDB()))->all();

        return $this->view('admin.mission.form', compact('mission', 'countries'));
    }

    public function update(int $id)
    {
        $this->isAdmin();

        $mission = new Mission($this->getDB());

        $countries = array_pop($_POST);
        $result = $mission->update($id, $_POST, $countries);

        if ($result) {
            return header('Location: /the_shadow_spies/admin/missions');
        }
        return $this;
    }

    public function destroy(int $id)
    {
        $this->isAdmin();

        $mission = new Mission($this->getDB());
        $result = $mission->destroy($id);

        if ($result) {
            return header('Location: /the_shadow_spies/admin/missions');
        }
        return $this;
    }
}