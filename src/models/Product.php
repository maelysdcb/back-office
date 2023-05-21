<?php

namespace src\models;

use core\BaseModel;

class Product extends BaseModel
{

    public function __construct()
    {
        $this->table = "products";
        $conn = $this->getConnection();
    }
    public function addQuantity(int $id, int $amount) {
        $sql = "UPDATE " . $this->table ." SET quantity=quantity + :amount WHERE id=:id";
        $query = $this->_connexion->prepare($sql);
        $query->bindValue(":amount", $amount);
        $query->bindValue(":id", $id);
        $query->execute();
    }

    public function removeQuantity(int $id, int $amount){
        $sql = "UPDATE " . $this->table ." SET quantity=quantity - :amount WHERE id=:id";
        $query = $this->_connexion->prepare($sql);
        $query->bindValue(":amount", $amount);
        $query->bindValue(":id", $id);
        $query->execute();
    }

    public function removeQuantityto0(int $id){
            $sql = "UPDATE " . $this->table . " SET quantity=0 WHERE id=:id";
            $query = $this->_connexion->prepare($sql);
            $query->bindValue(":id", $id);
            $query->execute();
    }
}
