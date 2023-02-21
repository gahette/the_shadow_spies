<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Mission;

class AdminMissionController extends Controller
{
    public function index()
    {
        $missions = (new Mission($this->getDB()))->all();

        return $this->view('admin.mission.index', compact('missions'));
    }

    public function edit(int $id)
    {
        $mission = (new Mission($this->getDB()))->findById($id);

        return $this->view('admin.mission.edit', compact('mission'));
    }

    public function update(int $id)
    {
        $mission = new Mission($this->getDB());
       $result =  $mission->update($id, $_POST);

        if ($result) {
            return header('Location: /the_shadow_spies/admin/missions');
        }
    }
    public function destroy(int $id)
    {
        $mission = new Mission($this->getDB());
        $result = $mission->destroy($id);

        if ($result) {
            return header('Location: /the_shadow_spies/admin/missions');
        }
    }
}