<?php

class Database
{
    private $conn;

    public function __construct()
    {
        require_once '../config/config.php';
        $this->conn = $conn;
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function getAllProducts()
    {
        $sql = "SELECT id, name, price, description FROM products";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result;
        } else {
            return [];
        }
    }

    public function insertProduct($name, $price, $description)
    {
        $stmt = $this->conn->prepare("INSERT INTO products (name, price, description) VALUES (?, ?, ?)");
        $stmt->bind_param("sds", $name, $price, $description);
        return $stmt->execute();
    }
}
