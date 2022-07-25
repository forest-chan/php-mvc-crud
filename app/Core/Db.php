<?php


namespace app\Core;

use PDO, PDOException;


class Db
{

    private $config;
    private $db;
    private $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    public function __construct()
    {
        $this->config = require $_SERVER['DOCUMENT_ROOT'] . '/../app/Config/db.php';
        try {

            $db = new PDO("mysql:host={$this->config['host']};dbname={$this->config['dbname']}", $this->config['username'], $this->config['password'], $this->opt);
            $this->db = $db;
        } catch (PDOException $e) {
            echo "An error occurs when connecting to db: " . $e->getMessage();
            exit();
        }
    }


    public function query(string $sql){
        return $this->db->query($sql);
    }

    public function fetch($stmt){
        return $stmt->fetch(PDO::FETCH_LAZY);
    }

    public function prepare($sql){
        return $this->db->prepare($sql);
    }

    public function fetchAll($stmt){
        return $stmt->fetchAll();
    }

    public function setOpt(array $opt){
        $this->opt = $opt;
    }

}
