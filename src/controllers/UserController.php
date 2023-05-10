<?php

namespace src\controllers;

use core\BaseController;
use src\models\User;

class UserController extends BaseController
{

    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new User();
    }

    public function displayUsers()
    {
        $title = "Users";
        $button = "Add a user";
        $users = $this->model->getAll();
        $this->render('users/users.html.twig', [
            'title' => $title,
            'button' => $button,
            'users' => $users
        ]);
    }

    public function displayUser()
    {   $title = "Users - Update";
        $userInfo = $this->model->getOne($_GET['id']);
        $this->render('users/update.html.twig', [
            'title' => $title,
            'user' => $userInfo
        ]);
    }
    public function updateUser()
    {
        $updateUser = $this->model->updateAllFields($_GET['id'], $_POST);
        header("Location:/users/update?id=" . $_GET['id']);
    }

    public function deleteUser() {
        $deleteUser = $this->model->deleteOne($_GET['id']);
        header("Location:/users");
    }

    
    public function addUser() {
        $_POST['credits'] = intval($_POST['credits']);
        $_POST['isAdmin'] = intval($_POST['isAdmin']);
        $addUser = $this->model->addAllFields($_POST);
        header("Location:/users");  
    }
    
    public function displayAddUser() {
        $title = "Users - Add";
        $this->render('users/add-user.html.twig', [
            'title' => $title,
        ]);
    }
}
