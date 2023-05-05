<?php

namespace src\controllers;

use core\BaseController;
use src\models\User;

class UserController extends BaseController {

    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new User();
    }

    public function displayUsers() {
        $title="Users";
        $button = "Add a user";
        $users = $this->model->getAll();
        $this->render('users/users.html.twig', [
            'title' => $title,
            'button' => $button,
            'users' => $users
        ]);
    }
}