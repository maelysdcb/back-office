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
        $products = $this->model->getAll();
        $title = "Products";
        $button = "Add a product";
       
        $this->render('products/list.html.twig', [
            'title' => $title,
            'button' => $button,
            'products' => $products
        ]);
    }
    public function displayProduct()
    {   $title = "Product - Update";
        $productInfo = $this->model->getOne($_GET['id']);
        $this->render('products/update.html.twig', [
            'title' => $title,
            'product' => $productInfo
        ]);
    }

    public function deleteProduct() {
        $deleteProduct= $this->model->deleteOne($_GET['id']);
        header("Location:/products");
    }
    public function displayAddProduct() {
        $title = "Product - Add";
        $this->render('products/add-product.html.twig', [
            'title' => $title,
        ]);
    }

    public function addProduct() {
        $_POST['quantity'] = intval($_POST['quantity']);
        $_POST['price'] = intval($_POST['price']);
        $addProduct = $this->model->addAllFields($_POST);
        header("Location:/products");  
    }

    // public function updateProduct()
    // {
    //     $updateProduct = $this->model->updateAllFields($_GET['id'], $_POST);
    //     header("Location:/products/update?id=" . $_GET['id']);
    // }
}
