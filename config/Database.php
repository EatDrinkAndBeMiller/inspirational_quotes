<?php 
  class Database {
/*     // DB Params (to connect to local host)
    private $host = 'localhost';
    private $db_name = 'quotes_final';
    private $username = 'root';
    private $password = ''; */
    
    private $conn;

    // DB Connect
    public function connect() {
        $url = getenv('JAWSDB_URL');
        $dbparts = parse_url($url);

        $hostname = $dbparts['host'];
        $username = $dbparts['user'];
        $password = $dbparts['pass'];
        $database = ltrim($dbparts['path'],'/');
      
        $dsn = "mysql:host={$hostname};dbname={$database}";
       
        $this->conn = null;

      try { 
        $this->conn = new PDO($dsn, $username, $password);
        /* $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password); */

      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }
      //return the connection
      return $this->conn;
    }
  }

 
        


