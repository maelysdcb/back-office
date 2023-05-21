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
        $this->checkInactivity();
        $this->usersModel = new User();
        $this->productsModel = new Product();
    }

    public function index() {
        $title="Dashboard";
        $countAllAdmin = $this->usersModel->selectCountAllWhereCondition("isAdmin", "=", 1);
        $countAllEmployees = $this->usersModel->selectCountAllWhereCondition("isAdmin", "=", 0);
        $countAllUsers = $this->usersModel->selectCountAll();
        $countAllUnavailableProducts = $this->productsModel->selectCountAllWhereCondition("quantity", "<=", 0);
        $countAllStock = $this->productsModel->selectCountAllWhereCondition("quantity", ">", 0);
        $countAllProducts = $this->productsModel->selectCountAll();
        $this->render('dashboard/dashboard.html.twig', [
            'title' => $title,
            'allUsers' => $countAllUsers,
            'allAdmin' => $countAllAdmin,
            'allEmployees' => $countAllEmployees,
            'allProducts' => $countAllProducts,
            'allUnavailable' => $countAllUnavailableProducts,
            'allStock' => $countAllStock
        ]);
    }
}