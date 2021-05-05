<?php 
  class Database {
/*     // DB Params (to connect to local host)
    private $host = 'localhost';
    private $db_name = 'quotes_final';
    private $username = 'root';
    private $password = ''; */
    
    /* private $host = 'frwahxxknm9kwy6c.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
    private $db_name = 'l1q86343j7vkzl0r';
    private $username = 'b14glho9exaaatls';
    private $password = 'dudegci2oe5zgx9s'; */
    
    protected $url = getenv('mysql://b14glho9exaaatls:dudegci2oe5zgx9s@frwahxxknm9kwy6c.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/l1q86343j7vkzl0r');
    protected $dbparts = parse_url($url);

    protected $hostname = $dbparts['host'];
    protected $username = $dbparts['user'];
    protected $password = $dbparts['pass'];
    protected $database = ltrim($dbparts['path'],'/');
      
    protected $dsn = "mysql:host={$hostname};dbname={$database}";

    private $conn;

    // DB Connect
    public function connect() {
            
        $this->conn = null;

      try { 
        /* $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password); */
        $this->conn = new PDO($this->dsn, $this->username, $this->password);

        //catch error mode
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }
      //return the connection
      return $this->conn;
    }
  }