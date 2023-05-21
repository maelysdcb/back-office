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
        $this->checkInactivity();
        $this->model = new Product();
    }

    public function displayList()
    {
        $products = $this->model->getAll();
        if ($_SERVER['REQUEST_URI'] == '/api/products') {
            $this->outPutJson($products);
        } else {
            $title = "Products";
            $button = "Add a product";

            $this->render('products/list.html.twig', [
                'title' => $title,
                'button' => $button,
                'products' => $products
            ]);
        }
    }

    public function displayProduct()
    {
        $title = "Product - Update";
        $productInfo = $this->model->getOne($_GET['id']);
        $this->render('products/update.html.twig', [
            'title' => $title,
            'product' => $productInfo
        ]);
    }

    public function deleteProduct()
    {
        $deleteProduct = $this->model->deleteOne($_GET['id']);
        header("Location:/products");
    }

    public function displayAddProduct()
    {
        $title = "Product - Add";
        $this->render('products/add-product.html.twig', [
            'title' => $title,
        ]);
    }

    public function addProduct()
    {
        if (!empty(trim($_POST['name'])) && !empty(trim($_POST['price'])) && !empty(trim($_POST['quantity'])) && !empty(trim($_POST['image']))) {
            $_POST['quantity'] = intval($_POST['quantity']);
            $_POST['price'] = intval($_POST['price']);
            $addProduct = $this->model->addAllFields($_POST);
            header("Location:/products");
        }
    }

    public function updateProduct()
    {
        if (!empty(trim($_POST['name'])) && !empty(trim($_POST['price'])) && !empty(trim($_POST['quantity'])) && !empty(trim($_POST['image']))) {
            $updateProduct = $this->model->updateAllFields($_GET['id'], $_POST);
            header("Location:/products/update?id=" . $_GET['id']);
        }
    }

    public function restockQuantity()
    {
        $quantity = 10;
        $addQuantity = $this->model->addQuantity($_GET['id'], $quantity);
        header("Location:/products/update?id=" . $_GET['id']);
    }

    public function removeStock()
    {
        $quantity = 10;
        $productInfo = $this->model->getOne($_GET['id']);

        if ($productInfo->quantity <= 0) {
            var_dump($productInfo->quantity);
            $removeQuantityto0 = $this->model->removeQuantityto0($_GET['id']);
            header("Location:/products/update?id=" . $_GET['id']);
        } else {
            $removeQuantity = $this->model->removeQuantity($_GET['id'], $quantity); 
            echo $this->outPutJson($productInfo);
        }
    }
}
