<?php

namespace src\controllers;

use core\BaseController;
use src\models\User;
use src\models\Product;

class ApiController extends BaseController
{

    private $usersModel;
    private $productsModel;

    public function __construct()
    {
        parent::__construct();
        $this->checkInactivity();
        $this->usersModel = new User();
        $this->productsModel = new Product();
    }

    public function displayListAPI()
    {
        $products = $this->productsModel->getAll();
        $this->outPutJson($products);
    }

    public function removeStockAPI()
    {
        $quantity = 1;
        $productInfo = $this->productsModel->getOne($_GET['id']);

        if ($productInfo->quantity <= 0) {
            $removeQuantityto0 = $this->productsModel->removeQuantityto0($_GET['id']);
            header("Location:/products/update?id=" . $_GET['id']);
        } else {
            $removeQuantity = $this->productsModel->removeQuantity($_GET['id'], $quantity);
            echo $this->outPutJson($productInfo);
        }
    }

    public function authAPI()
    {
        $json = file_get_contents('php://input');
        $decodeJSON = $this->decodeJson($json);

        if (!empty(trim($json))) {

            $user = $this->usersModel->checkAuthAPI($decodeJSON);

            if (password_verify($decodeJSON['password'], $user['password'])) {
                echo "{\"status\": true}";
            } else {
                echo "{\"status\": false}";
            }
        } else {

            echo "{\"status\": false}";
        }
    }
}
