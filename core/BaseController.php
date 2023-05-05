<?php

namespace core;

class BaseController
{
    private $twig;
    public function __construct()
    {
        $loader = new \Twig\Loader\FileSystemLoader('../views');
        $this->twig = new \Twig\Environment($loader);
    }

    public function render($name, $context)
    {
        echo $this->twig->render($name, $context);
    }
}
