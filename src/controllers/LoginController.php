<?php 

namespace src\controllers;

use core\BaseController;

class LoginController extends BaseController
{
    public function displayLogin()
    {
        $title = "Login";
        $this->render('login/login.html.twig', [
            'title' => $title
        ]);
    }
}