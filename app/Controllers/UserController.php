<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function login()
    {
        return $this->view('auth.login');
    }

    public function loginPost()
    {
        $user = (new User($this->getDB()))->getByUsername($_POST['username']);

        if (password_verify($_POST['password'], $user->password)) {
            // definir la session
            $_SESSION['auth'] = (int)$user->admin;
            return header('Location: /the_shadow_spies/admin/missions?success=true');
        } else {
            return header('Location: /the_shadow_spies/login');
        }
    }

    public function logout()
    {
        session_destroy();

        return header('Location: /the_shadow_spies/');
    }
}