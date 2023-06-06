<?php

namespace core;

abstract class BaseModel
{
    private $host = 'localhost', $db_name = 'back_office', $username = 'root', $password = '';
    protected $_connexion;
    protected $table, $id, $data = [];

    public function getConnection()
    {
        $this->_connexion = null;

        try {
            $this->_connexion = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->_connexion->exec("set names utf8");
            $this->_connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    public function checkAuth($data) {
        $sql= "SELECT * FROM " . $this->table . " WHERE email=:email AND isAdmin=1";
        $query = $this->_connexion->prepare($sql);
        $query->bindValue(":email", $data['email']);
        $query->execute();
        return $query->fetch(\PDO::FETCH_OBJ);
    }
    
    public function checkAuthAPI($data) {
        $sql= "SELECT * FROM " . $this->table . " WHERE email=:email";
        $query = $this->_connexion->prepare($sql);
        $query->bindValue(":email", $data["email"]);
        $query->execute();
        $result= $query->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getOne(int $id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id=:id";
        $query = $this->_connexion->prepare($sql);
        $query->bindValue(":id", $id);
        $query->execute();
        return $query->fetch(\PDO::FETCH_OBJ);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_OBJ);
    }

    public function selectCountAll() {
        $sql = "SELECT COUNT(*) FROM " . $this->table;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function selectCountAllWhereCondition($column, $operator, int $value) {
        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE " . $column . $operator . ":value";
        $query = $this->_connexion->prepare($sql);
        $query->bindValue(":value", $value);
        $query->execute();
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateAllFields(int $id, $data)
    {
        $sql = "UPDATE " . $this->table . " SET ";
        $setStatements = [];
        foreach ($data as $column => $value) {
            $setStatements[] = $column . " = :" . $column;
        }
        $sql .= implode(", ", $setStatements);
        $sql .= " WHERE id=$id";

        $query = $this->_connexion->prepare($sql);
        $query->bindValue(":id", $id);
        foreach ($data as $column => $value) {
            $query->bindValue(":" . $column, $value);
        }
        $query->execute();
    }

    public function deleteOne(int $id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id=:id";
        $query = $this->_connexion->prepare($sql);
        $query->bindValue(":id", $id);
        $query->execute();
    }

    public function addAllFields($data) {
        $columns = implode(", ", array_keys($data));
        $values = implode(", :", array_keys($data));
        
        $sql = "INSERT INTO " . $this->table . " (" . $columns . ") VALUES (:" . $values . ")";
    
        $query = $this->_connexion->prepare($sql);
        foreach ($data as $column => $value) {
            $query->bindValue(":" . $column, $value);
        }
        $query->execute();
    }
}
