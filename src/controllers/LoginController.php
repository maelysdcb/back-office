<?php 

namespace src\controllers;

use core\BaseController;
use src\models\User;

class LoginController extends BaseController
{
    private $model;
    public function __construct()
    {
        parent::__construct();
        $this->checkInactivity();
        $this->model = new User();
    }

    public function displayLogin()
    {
        $title = "Login";
        $this->render('login/login.html.twig', [
            'title' => $title
        ]);
    }

    public function login() {
        if(!empty(trim($_POST['password'])) && !empty(trim($_POST['email']))){
            $user = $this->model->checkAuth($_POST);
            if(password_verify($_POST['password'], $user->password)) {
                $_SESSION['user'] = $user;
                header("Location:/");
            } else {
                echo "<script>alert('Accès refusé')</script>";
            }
        } else {
            
        }
    }

    public function logout() {
        unset($_SESSION['user']);
        header("Location:/login");
    }
}