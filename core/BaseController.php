<?php

namespace core;

class BaseController
{
    private $twig;
    public function __construct()
    {
        $loader = new \Twig\Loader\FileSystemLoader('../views');
        $this->twig = new \Twig\Environment($loader);
        $this->twig->addGlobal('session', $_SESSION);
    }

    public function render($name, $context)
    {
        echo $this->twig->render($name, $context);
    }

    public function outPutJson($array){
        header('Content-Type: application/json');
        echo json_encode($array);
    }

    public function checkInactivity()
    {
        if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > 300) {
            session_unset();
            header("Location:/login");
            exit;
        }
        $_SESSION['last_activity'] = time();
    }
}
