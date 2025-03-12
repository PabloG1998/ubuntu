<?php
class Database {
   
  //Hostinger 
   private $host = 'localhost';
   private $dbname = 'u810780627_ubuntudb';
   private $user = 'u810780627_ubuntudb';
   private $password = 'Ubuntu2020sql';
   
   public $conn;
   //Localhost 
   /*
   private $host = 'localhost';
   private $dbname = 'ubuntudb';
   private $user = 'root';
   private $password = '';
   */
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}