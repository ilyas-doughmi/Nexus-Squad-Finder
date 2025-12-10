<?php 
Class db{
    private $host = "localhost";
    private $db_name = "ASTRAL";
    private $user = "root";
    private $password = "";

    protected function connect(){
        try{

            $pdo = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name,$this->user,$this->password,
            [
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
            ]);

            return $pdo;
            
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}