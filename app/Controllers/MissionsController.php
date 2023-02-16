<?php

namespace App\Controllers;

    class MissionsController{
        public function index()
        {
            echo 'Je suis la homepage';
        }
        public function show(int $id)
        {
            echo 'Je suis la missions '. $id;
        }
    }
