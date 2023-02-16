<?php

namespace App\Controllers;

    class MissionController extends Controller{
        public function index()
        {
           return $this->view('mission.index');
        }
        public function show(int $id)
        {
           $req=$this->db->getPDO()->query('SELECT * FROM spies.missions');
           $missions = $req->fetchAll();
           var_dump($missions);

            return $this->view('mission.show', compact('id'));
        }
    }
