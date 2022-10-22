<?php 
namespace App\Database\Config;


class connection {
    private $hostName = "localhost";
    private $userName = "root";
    private $password = "";
    private $port = "3306";
    private $dataBase = "ecommerce";
    public $connection;
    public function __construct()
    {
        $this->connection = new \mysqli($this->hostName , $this->userName , $this->password , $this->dataBase , $this->port );
    }

}