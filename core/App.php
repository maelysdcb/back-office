<?php

namespace core;

use src\controllers\ProductController;
use src\controllers\HomeController;
use src\controllers\LoginController;
use src\controllers\UserController;

class App
{
    public function run()
    {
        session_start();
        $uri = strtok($_SERVER['REQUEST_URI'], '?');

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
            $controller->displayUser();
            if (isset($_POST['id'])) {
                $controller->updateUser();
            }
        } elseif ($uri == '/users/delete' && isset($_GET['id'])) {
            $controller = new UserController();
            $controller->deleteUser();
        } elseif ($uri == '/products') {
            $controller = new ProductController();
            $controller->displayList();
        } elseif ($uri == '/products/update' && isset($_GET['id'])) {
            $controller = new ProductController();
            $controller->displayProduct();
            // if(isset($_POST['id'])){
            //     $controller->updateProduct();
            // }
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
        } elseif ($uri == '/login') {
            $controller = new LoginController();
            $controller->displayLogin();
        } else {
            http_response_code(404);
            echo 'Page introuvable';
        }
    }
}
