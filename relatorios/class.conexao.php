<?php

class Conexao {
    private $servidor="localhost";
    private $username="marcio";
    private $passw="M@rcego02";
    private $dbname="nitcabs";

    public function conectar(){
        $link = new mysqli($this->servidor,$this->username,$this->passw,$this->dbname);
        if ($link->connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }
    
}