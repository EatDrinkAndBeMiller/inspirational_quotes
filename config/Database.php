<?php 
  class Database {
    // DB Params (to connect)
    private $host = 'localhost';
    private $db_name = 'quotes_final';
    private $username = 'root';
    private $password = '';
    //represents connection
    private $conn;

    // DB Connect
    public function connect() {
      $this->conn = null;

      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        //catch error mode
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }
      //return the connection
      return $this->conn;
    }
  }