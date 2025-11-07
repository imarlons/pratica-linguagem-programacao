<?php

class Database
{
    private $host = 'localhost';
    private $db_name = 'empresa';
    private $username = 'root';
    private $password = '';
    private $port = 3307;
    private $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            $dsn = 'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->db_name;

            $this->conn = new PDO(
                $dsn,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erro de conexão: ' . $e->getMessage());
        }
        return $this->conn;
    }
}
