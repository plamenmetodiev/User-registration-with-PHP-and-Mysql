<?php

require_once 'database.php';

    class User {

        //Constructor
        public function __construct(){
            $database = new Database();
            $db = $database->dbConnection();
            $this->conn = $db;
        }

        //Execute queries
        public function runQuery($sql){
            $stmt = $this->conn->prepare($sql);
            return $stmt;
        }

        //Insert
        public function insert($firstname, $lastname, $email, $phonenumber, $password){
            try {
                $stmt = $this->conn->prepare("INSERT INTO users (firstname, lastname, email, phonenumber, password) VALUES(:firstname, :lastname, :email, :phonenumber, :password)");
                $stmt->bindparam(":firstname", $firstname);
                $stmt->bindparam(":lastname", $lastname);
                $stmt->bindparam(":email", $email);
                $stmt->bindparam(":phonenumber", $phonenumber);
                $stmt->bindparam(":password", $password);
                $stmt->execute();
                return $stmt;

            } catch (PDOException $e) {
                echo $e->getMessage();
            }

        }

        //Update

        // Delete
    public function delete($id){
        try{
          $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :id");
          $stmt->bindparam(":id", $id);
          $stmt->execute();
          return $stmt;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
      }
  
      // Redirect URL method
      public function redirect($url){
        header("Location: $url");
      }

    }
?>