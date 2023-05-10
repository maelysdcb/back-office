<?php

namespace src\controllers;

use core\BaseController;
use src\models\User;
use src\models\Product;

class HomeController extends BaseController {

    private $usersModel;
    private $productsModel;
    public function __construct()
    {
        parent::__construct();
        $this->usersModel = new User();
        $this->productsModel = new Product();
    }

    public function index() {
        $title="Dashboard";
        $countAllUsers = $this->usersModel->selectCountAll();
        $countAllProducts = $this->productsModel->selectCountAll();
        $this->render('dashboard/dashboard.html.twig', [
            'title' => $title,
            'allUsers' => $countAllUsers,
            'allProducts' => $countAllProducts
        ]);
    }
}