<?php

namespace core;

use LogicException;
use src\controllers\ProductController;
use src\controllers\HomeController;
use src\controllers\LoginController;
use src\controllers\UserController;

class App
{
    public function __construct() {
        session_start();
    }
    public function run()
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        if(isset($_SESSION['user'])) {
            if ($uri == '/') {
                $controller = new HomeController();
                $controller->index();
            } elseif ($uri == '/users') {
                $controller = new UserController();
                $controller->displayUsers();
            } elseif ($uri == '/users/add-user') {
                $controller = new UserController();
                if (!empty($_POST)) {
                    $controller->addUser();
                } else {
                    $controller->displayAddUser();
                }
            } elseif ($uri == '/users/update' && isset($_GET['id'])) {
                $controller = new UserController();
                if(isset($_POST['id'])) {
                    $controller->updateUser();
                }
                $controller->displayUser();
            } elseif ($uri == '/users/delete' && isset($_GET['id'])) {
                $controller = new UserController();
                $controller->deleteUser();
            } else if($uri == '/api/products'){
                $controller = new ProductController();
                $controller->displayList();
            } else if($uri == '/api/products/consume' && isset($_GET['id'])){
                $controller = new ProductController();
                $controller->removeStock();
            } elseif ($uri == '/products') {
                $controller = new ProductController();
                $controller->displayList();
            } elseif ($uri == '/products/update' && isset($_GET['id'])) {
                $controller = new ProductController();
                if(isset($_POST['id'])){
                    $controller->updateProduct();
                }
                $controller->displayProduct();
            } elseif ($uri == '/products/addQuantity' && isset($_GET['id'])) {
                $controller = new ProductController();
                $controller->restockQuantity();
            // } elseif ($uri == '/products/removeQuantity' && isset($_GET['id'])) {
            //     $controller = new ProductController();
            //     $controller->restockQuantity(); 
            } elseif ($uri == '/products/delete' && isset($_GET['id'])) {
                $controller = new ProductController();
                $controller->deleteProduct();
            } elseif ($uri == '/products/add-product') {
                $controller = new ProductController();
                if (!empty($_POST)) {
                    $controller->addProduct();
                } else {
                    $controller->displayAddProduct();
                }
            } elseif ($uri == '/settings') {
                echo "Settings";
            } elseif ($uri == '/logout') {
                $controller = new LoginController();
                $controller->logout();
            } else {
                http_response_code(404);
                echo 'Page introuvable';
            }
        } else {
            $controller = new LoginController();
            $controller->displayLogin();
            if($uri == '/auth') {
                $controller = new LoginController();
                $controller->login();
                $controller->displayLogin();
            }
        }
    }
}
