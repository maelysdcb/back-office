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

    public function decodeJson($array)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Content-Type');
        $data = json_decode($array, true);
        return $data;
    }

    public function outPutJson($array)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($array);
    }

    public function checkInactivity()
    {
        if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > 1000) {
            session_unset();
            header("Location:/login");
            exit;
        }
        $_SESSION['last_activity'] = time();
    }
}
