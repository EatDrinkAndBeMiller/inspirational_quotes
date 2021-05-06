<?php 
  class Database {
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
        
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }
      //return the connection
      return $this->conn;
    }
  }

  //catch error mode
        /* $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); */
        /* $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password); */


        /*     // DB Params (to connect to local host)
    private $host = 'localhost';
    private $db_name = 'quotes_final';
    private $username = 'root';
    private $password = ''; */
    
    /* private $host = 'frwahxxknm9kwy6c.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
    private $db_name = 'l1q86343j7vkzl0r';
    private $username = 'b14glho9exaaatls';
    private $password = 'dudegci2oe5zgx9s'; */