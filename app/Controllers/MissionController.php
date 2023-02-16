<?php

namespace App\Controllers;

    class MissionController extends Controller{
        public function index()
        {
           return $this->view('mission.index');
        }
        public function show(int $id)
        {
            return $this->view('mission.show', compact('id'));
        }
    }
