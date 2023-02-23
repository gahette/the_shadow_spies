<?php

namespace App\Controllers;

use App\Models\User;
use App\Validation\Validator;

class UserController extends Controller
{
    public function login()
    {
        $this->view('auth.login');
    }

    public function loginPost()
    {
        $validator = new Validator($_POST);
        $errors = $validator->validate([
            'username' => ['required', 'min:3'],
            'password' => ['required']
        ]);
        {
            if ($errors) {
                $_SESSION['errors'][] = $errors;
                header('Location: /the_shadow_spies/login');
                exit;
            }
        }

        $user = (new User($this->getDB()))->getByUsername($_POST['username']);

        if (password_verify($_POST['password'], $user->password)) {
            // definir la session
            $_SESSION['auth'] = (int)$user->admin;
            header('Location: /the_shadow_spies/admin/missions?success=true');
        } else {
            header('Location: /the_shadow_spies/login');
        }
        exit;
    }

    public function logout()
    {
        session_destroy();

        header('Location: /the_shadow_spies/');
        exit;
    }
}