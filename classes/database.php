<?php

class Database{

    private $host = "localhost:3306";
    private $dbuser = "root";
    private $dbpass = "";
    private $dbname = "user_accounts";

    public $conn;

    public function dbConnection(){
        $this->conn = null;
        
        try{
            $this->conn = new PDO('mysql:host=' . $this->host . 'localhost:3306;dbname=' . $this->dbname . ';charset=utf8', $this->dbuser, $this->dbpass, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ));
        } catch (PDOException $exception){
            echo 'Connection error: ' . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
