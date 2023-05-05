<?php

namespace core;

use src\controllers\ProductController;
use src\controllers\HomeController;
use src\controllers\UserController;

class App
{
    public function run()
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');

        if ($uri == '/') {
            $controller = new HomeController();
            $controller->index();
        } elseif ($uri == '/users') {
            $controller = new UserController();
            $controller->displayUsers();
        } elseif ($uri == '/users/update' && isset($_GET['id'])) {
            $controller = new UserController();
            if (isset($_POST['id'])) {
                $controller->updateUser();
            }
            $controller->displayUser();
        } elseif ($uri == '/products') {
            $controller = new ProductController();
            $controller->displayList();
        } elseif ($uri == '/settings') {
            echo "Settings";
        } else {
            http_response_code(404);
            echo 'Page introuvable';
        }
    }
}
