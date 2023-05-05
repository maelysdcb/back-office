<?php

namespace src\controllers;

use core\BaseController;

class HomeController extends BaseController {
    public function index() {
        $title="Dashboard";
        $this->render('dashboard/dashboard.html.twig', [
            'title' => $title
        ]);
    }
}