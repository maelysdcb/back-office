<?php

namespace core;

use src\controllers\ProductController;
use src\controllers\HomeController;
use src\controllers\UserController;

class App
{
    public function run()
    {
        if ($_SERVER['REQUEST_URI'] == '/') {
            $controller = new HomeController();
            $controller->index();
        } elseif ($_SERVER['REQUEST_URI'] == '/users') {
            $controller = new UserController();
            $controller->displayUsers();
        } elseif ($_SERVER['REQUEST_URI'] == '/products') {
            $controller = new ProductController();
            $controller->displayList();
        } elseif ($_SERVER['REQUEST_URI'] == '/settings') {
            echo "Settings";
        } else {
            http_response_code(404);
            echo 'Page introuvable';
        }
    }
}
