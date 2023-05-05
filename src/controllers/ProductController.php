<?php

namespace src\controllers;

use core\BaseController;
use src\models\Product;

class ProductController extends BaseController
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Product();
    }
    
    public function displayList()
    {
        $title = "Products";
        $button = "Add a product";
        $products = $this->model->getAll();
        
        $this->render('products/list.html.twig', [
            'title' => $title,
            'button' => $button,
            'products' => $products
        ]);
    }
}
